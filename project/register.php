
<?php
    
    
    include_once('includes/session.php');
    
    include_once('database/connection.php');
    include_once('database/tags.php');

    $title = 'PetRescue - Register';
    include_once('templates/common/header.php');

    include_once('templates/common/print-messages.php');

    include_once('templates/user/register.php');

    unset($_SESSION['print']);


    include_once('templates/common/footer.php');


?>