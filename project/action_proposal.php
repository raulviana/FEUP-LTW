<?php

include_once('includes/session.php');

include_once('database/connection.php');
include_once('database/proposal.php');

include_once('templates/files/process-files.php');


if ($_SESSION['csrf'] !== $_POST['csrf']) {
    $_SESSION['error_messages'][] = "Bad request, try again";
    header('Location: proposal.php');
}

try{
    $files = $_FILES;
    
    $location = preg_replace ("/[^a-zA-Z\s]/", '', $_POST['location']);
    $content = preg_replace ("/[^a-zA-Z\s]/", '', $_POST['content']);
    $pet_id = preg_replace ("/[^a-zA-Z0-9\s]/", '', $_POST['pet-id']);
    $poster_id = preg_replace ("/[^0-9\s]/", '', $_SESSION['user_id']);

    $photo_ids = add_proposal($location, $content, $pet_id, $poster_id, $files);

    $image_source = 'proposal';
    process_files($photo_ids, $files, $image_source);
    clearMessages();

    $_SESSION['success_messages'][] = "Proposal Sent!";
    $_SESSION['print'] = 'success';
    header('Location:pet_page.php?pet-id=' . $pet_id);
    die;
}
catch(PDOException $e){
    $e->getMessage();
    print_r($e);
    foreach($paths as $path){
        unlink($path);
    }
    $_SESSION['print'] = 'error';
    $_SESSION['error_messages'][] = "Failed to send proposal!";
    header('Location:proposal.php' . $_POST['pet_id']);
}



?>