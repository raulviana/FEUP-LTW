
<?php

function searchByTag($tag_id){
    global $db;
   
    $stm = $db->prepare('SELECT * FROM pets WHERE pet_tag = ?');
    $stm->execute(array($tag_id));
    return $stm->fetchAll();
}

function search($search){
    $search_terms = explode(' ', $search); 
       
    global $db;
    $perc = '%';
    $result = array();
    foreach($search_terms as $term){
        
        $term = $perc . $term . $perc;
        $stm = $db->prepare('SELECT * FROM pets WHERE ("location" || "description" || "name") LIKE ? LIMIT 25');
        $stm->execute(array($term));

        $temp = $stm->fetchAll(); 
        foreach($temp as $pet){
            array_push($result, $pet);
        }
    }
    return $result;
}


?>