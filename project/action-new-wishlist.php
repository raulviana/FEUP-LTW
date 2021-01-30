<?php

    include_once('includes/session.php');

    include_once('database/connection.php');
    include_once('database/pets.php');

    try{
        $name = preg_replace ("/[^a-zA-Z!_0-9?.\-\s]/", '', $_POST['name']);
        $pet_id = preg_replace ("/[^0-9\s]/", '', $_POST['pet-id']);
        $id = preg_replace ("/[^0-9\s]/", '', $_POST['id']);

        addWishlist($name, $pet_id, $id);
       
        header('Location:wishlist.php');
        die;
    }
    catch(PDOException $e){
        $e->getMessage();
        $_SESSION['error_messages'][] = $e;
        header('Location:wishlist.php');
    }
    
    
  
?>