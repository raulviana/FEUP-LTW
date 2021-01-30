<?php

include_once('includes/session.php');
include_once('database/connection.php');
include_once('database/pets.php');

$pet_id = preg_replace ("/[^0-9\s]/", '', $_GET['pet-id']);
$wish_id = preg_replace ("/[^0-9\s]/", '', $_GET['wish-id']);


try{
    addPetToWishlist($wish_id, $pet_id);
    $pet = getPet($pet_id);
    $photos = getPetPhotos($pet);
    $_SESSION['print'] = 'success';
    $_SESSION['success_messages'] = 'Pet Added to Wishlist!';
}
catch(PDOException $e){
    $e->getMessage();
    $_SESSION['print'] = 'success';
    $_SESSION['success_messages'] = 'Failed to Add Pet to Wishlist!';
}

header('Location: wishlist.php');

?>