
<?php

function add_proposal($location, $content, $pet_id, $poster_id, $files){
    $active = true;
    global $db;
    $date = date('Y:m:d h:i:s');
    $stm = $db->prepare('INSERT INTO proposal VALUES(NULL, ?, ?, ?, ?, ?, ?)');
    $stm->execute(array($content, $date, $location, $active, $poster_id, $pet_id));

    $id = $db->lastInsertId();

    $number_files = count($files['files']['name']);

    $photo_ids = array();

    for($i = 0; $i < $number_files; $i++){
        $stm = $db->prepare('INSERT INTO proposal_photo VALUES(NULL, ?, ?)');
        $stm->execute(array($files['files']['name'], $id));
        array_push($photo_ids, $db->lastInsertId());
    }
    return $photo_ids;
}

function getNumberProposals($pet_id){
    global $db;
    $stm = $db->prepare('SELECT COUNT(id) AS proposals FROM proposal WHERE pet_id = ?');
    $stm->execute(array($pet_id)); 
    return $stm->fetch();
}

function getProposalsByPet($pet_id){
    global $db;
    $stm = $db->prepare('SELECT proposal.id, proposal.content, proposal.date, proposal.location, proposal_photo.id AS "path", user.username, proposal.active, pets.name, pets.adopted, pets.poster
                         FROM proposal
                         INNER JOIN proposal_photo ON proposal.id = proposal_photo.proposal_id
                         INNER JOIN user ON proposal.proponent_id = user.id 
                         INNER JOIN pets ON proposal.pet_id = pets.id
                         WHERE pet_id = ?');
    $stm->execute(array($pet_id));
    return $stm->fetchAll();
}

function getProposalsByUser($user_id){
    global $db;
    $stm = $db->prepare('SELECT proposal.active, proposal.id, proposal.content, proposal.date, proposal.location, proposal_photo.path, user.username, proposal.active, pets.name, pets.adopted, pets.poster
                         FROM proposal
                         INNER JOIN proposal_photo ON proposal.id = proposal_photo.proposal_id
                         INNER JOIN user ON proposal.proponent_id = user.id 
                         INNER JOIN pets ON proposal.pet_id = pets.id
                         WHERE proponent_id = ?');
    $stm->execute(array($user_id));
    return $stm->fetchAll();
}

function acceptProposal($proposal_id){
    global $db;

    $stm = $db->prepare('UPDATE proposal SET  active = ? WHERE id = ?');
    $stm->execute(array(0, $proposal_id));

    $stm = $db->prepare('UPDATE pets 
                         SET adopted = ?, "owner" = (SELECT proponent_id FROM proposal WHERE id = ?) 
                         WHERE id = (SELECT pet_id from proposal WHERE id = ?)');
    $stm->execute(array(1, $proposal_id, $proposal_id));
}

?>