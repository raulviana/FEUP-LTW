
<?php

include_once('includes/session.php');

include_once('database/connection.php');
include_once('database/tags.php');
include_once('database/pets.php');

$title = 'PetRescue - Wishlist';
include_once('templates/common/header.php');

include_once('templates/common/print-messages.php');

include_once('templates/pets/wishlist.php');

include_once('templates/common/footer.php');

?>