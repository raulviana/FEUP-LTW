
<?php

include_once('database/connection.php');
include_once('database/user.php');

function add_user($username, $mail, $password){
    
    global $db;

    $options = ['cost' => 10];

    $stm = $db->prepare('INSERT INTO user VALUES(NULL, ?, ?, ?, NULL)');
    
    $stm->execute(array(
                    $username, 
                    $mail, 
                    password_hash($password, PASSWORD_BCRYPT, $options)));
    return $db->lastInsertId();
}

function validate_login($email, $password){

    global $db;

    $stm = $db->prepare('SELECT "password" FROM user where email = ? AND "password" = ?');

    $stm->execute(array($email, hash('sha256', $password)));
    
    return $stm->fetch() !== false;
    
}

function get_user($email){
    global $db;

    $stm = $db->prepare('SELECT * FROM user where email = ?');

    $stm->execute(array($email));
    
    return $stm->fetch();
}

?>

