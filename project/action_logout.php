
<?php
  include_once('includes/init.php');

  session_destroy();
  session_start();
 
  unset($_SESSION['username']);
  unset($_SESSION['user_id']);
  clearMessages();
  $_SESSION['print'] = 'success"';
  $_SESSION['success_messages'][] = "User logged out!";
  header('Location: index.php');
  die;
?>