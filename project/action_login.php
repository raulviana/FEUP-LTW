

<?php

    include_once('includes/session.php');

    include_once('database/connection.php');
    include_once('database/user.php');

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
    $_SESSION['error_messages'][] = "Bad request, try again";
    header('Location: login.php');
}

    $mail = preg_replace ("/[^a-zA-Z0-9_.@\-\s]/", '', $_POST['email']);
    $password = $_POST['password'];

    $user = get_user($mail);

    if ($user !== false && password_verify($password, $user['password'])) {
        setCurrentUser($user['username'], $user['id']);
        $_SESSION['print'] = 'success';
        $_SESSION['success_messages'][] = "Login Successful!"; 
        header('Location: index.php');
        die;
    } 
    else {
        $_SESSION['print'] = 'error';
        $_SESSION['error_messages'][] = "Login Failed!";
        header('Location: login.php');
        die;
    }
 
   

?>


