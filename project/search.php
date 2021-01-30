<?php

    include_once('includes/session.php');

    include_once('database/connection.php');
    include_once('database/search.php');
    include_once('database/pets.php');
    include_once('database/tags.php');
    $title = 'PetRescue - Search';
    include_once('templates/common/header.php');

    include_once('templates/common/print-messages.php');

    if(isset($_POST['search'])){
        $search_terms = preg_replace ("/[^a-zA-Z0-9\-\s]/", '', $_POST['search']);
    }

    try{
        if(isset($_GET['tag'])){
            $pets = searchByTag($_GET['tag']);

        }
        else $pets = search($search_terms); 
    }
    
    catch(PDOException $e){
        $e->getMessage();
        $_SESSION['error_messages'][] = "Failed search";
        header('Location:index.php');
    }
    if(count($pets) === 0){
        echo '<div class="no-pets">Sorry, no pet matches this search.</div>';
    }
    include_once('templates/pets/list_pets.php');

    include_once('templates/common/footer.php');
    
    
  
?>