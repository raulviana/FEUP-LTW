

<?php

include_once('includes/session.php');

include_once('database/connection.php');
include_once('database/pets.php');
include_once('templates/files/process-files.php');


if ($_SESSION['csrf'] !== $_POST['csrf']) {
    $_SESSION['error_messages'][] = "Bad request, try again";
    header('Location: add_pet.php');
}

try{
    $files = $_FILES;
    
    $pet_name = preg_replace ("/[^a-zA-Z\-0-9_\s]/", '', $_POST['pet-name']);
    $location = preg_replace ("/[^a-zA-Z\040\-\s]/", '', $_POST['location']);
    $age = preg_replace ("/[^0-9\s]/", '', $_POST['age']);
    $description = preg_replace ("/[^a-zA-Zçãõ!?éàáê\-.,;\040\s]/", '', $_POST['description']);
    $sizes = $_POST['sizes'];
    $tags = $_POST['tags'];
    $poster_id = $_POST['poster_id'];

    $photo_ids = add_pet($pet_name, $location, $age, $description, $sizes, $tags, $poster_id, $files);
   
    $image_source = 'pets';
    process_files($photo_ids, $files, $image_source);
    clearMessages();
    $_SESSION['success_messages'][] = 'New pet added';
    $_SESSION['print'] = 'success';
    header('Location:index.php');
    die;
}
catch(PDOException $e){
    $e->getMessage();
    $_SESSION['print'] = 'error';
    $_SESSION['error_messages'][] = 'Failed to add pet!';
    header('Location:add_pet.php');
}



?>