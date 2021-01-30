


<?php

include_once('includes/session.php');

include_once('database/connection.php');
include_once('database/tags.php');
include_once('database/pets.php');
include_once('database/proposal.php');

$pet = getPet($_GET['pet-id']);

$title = 'PetRescue - ' . $pet[0]['name'];
include_once('templates/common/header.php');

include_once('templates/common/print-messages.php');

include_once('templates/pets/pet_page.php');

include_once('templates/common/footer.php');

?>