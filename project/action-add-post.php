<?php

include_once('includes/session.php');
include_once('database/connection.php');
include_once('database/pets.php');

$text = preg_replace ("/[^0-9\040a-zA-Z!?.,\-\s]/", '', $_POST['content']);
$poster_id = preg_replace ("/[^0-9\s]/", '', $_POST['user_id']);
$pet_id = preg_replace ("/[^0-9\s]/", '', $_POST['pet_id']);
$username = preg_replace ("/[^a-zA-Z!?_0-9\-\s]/", '', $_POST['username']);
$date = date('Y:m:d h:i:s');

try{
    $id = addPetPost($text, $poster_id, $pet_id, $date);
    $_SESSION['print'] = 'success';
    $_SESSION['success_messages'] = 'Post Added!';
}
catch(PDOException $e){
    $e->getMessage();
    $_SESSION['error_messages'][] = "Failed to add post!";
    $return_array[] = array('error' => $e);
    $_SESSION['print'] = 'error';

    echo json_encode($return_array);
}

$return_array[] = array('content' => $text, 'pet_id' => $pet_id, 'user_id' => $poster_id, 'username' => $username, 'post_id' => $id);

echo json_encode($return_array);

?>
