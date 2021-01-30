
<?php

    include_once('includes/session.php');

    include_once('database/connection.php');
    include_once('database/user.php');

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        $_SESSION['error_messages'][] = "Bad request, try again";
        $_SESSION['print'] = 'error';
        header('Location: register.php');
    }

    $username = preg_replace ("/[^a-zA-Z_\-0-9\s]/", '', $_POST['username']);
    $mail = preg_replace ("/[^a-zA-Z0-9_.@\-\s]/", '', $_POST['email']);
    $password = $_POST['password'];

    if(strlen($password) < 6){
        $_SESSION['error_messages'][] = "Sorry: Password must have at least 6 characters";
        $_SESSION['print'] = 'error';
        header('Location:register.php');
        die;
    }
    if(! preg_match('/[A-Z]/', $password)){
        $_SESSION['error_messages'][] = "Sorry: Password must have at least one uppercase letter";
        $_SESSION['print'] = 'error';
        header('Location:register.php');
        die;
    }
    try{
        $user_id = add_user($username, $mail, $password);
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['success_messages'][] = "Logged In";
        $_SESSION['print'] = 'success';
        header('Location:index.php');
        die;
    }
    catch(PDOException $e){
        $e->getMessage();
        $_SESSION['print'] = 'error';
        $_SESSION['error_messages'][] = "Failed to Log In";
        header('Location:register.php');
    }
    
    
  
?>