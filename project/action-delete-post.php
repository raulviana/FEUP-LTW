<?php

include_once('includes/session.php');
include_once('database/connection.php');
include_once('database/pets.php');

$post_id = preg_replace ("/[^0-9\s]/", '', $_POST['post_id']);


try{
    deletePetPost($post_id);
    $_SESSION['print'] = 'success';
    $_SESSION['success_messages'] = 'Post Deleted!';
}
catch(PDOException $e){
    $e->getMessage();
    $_SESSION['error_messages'][] = "Failed to delete post!";
    $return_array[] = array('error' => $e);
    $_SESSION['print'] = 'success';

    echo json_encode($return_array);
}

$return_array[] = array('post_id' => $post_id);

echo json_encode($return_array);

?>