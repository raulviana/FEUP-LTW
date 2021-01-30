

<?php

include_once('includes/session.php');

include_once('database/connection.php');
include_once('database/tags.php');
include_once('database/pets.php');

$title = 'PetRescue - My Pets';
$pets = getMyPets($_SESSION['user_id']);
include_once('templates/common/header.php');

include_once('templates/common/print-messages.php');

if(count($pets) === 0){
    echo '<p class="no-wishlists">You didn&apos;t add any pet yet.</p>';
}
include_once('templates/pets/list_pets.php');

include_once('templates/common/footer.php');

?>