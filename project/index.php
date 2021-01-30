
<?php

    include_once('includes/session.php');

    include_once('database/connection.php');
    include_once('database/pets.php');
    include_once('database/tags.php');

    $pets = getAllPets();
    $title = 'PetRescue';
    include_once('templates/common/header.php');
    
    include_once('templates/common/print-messages.php');

    include_once('templates/pets/list_pets.php');

    include_once('templates/common/footer.php');

?>