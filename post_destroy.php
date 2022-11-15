<?php 
  session_start();
  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $user_id = $_POST['id'];
  $email = $_POST['email'];

  if (!isset($user_id) || (!is_numeric($user_id)))
  {
    echo 'You need a valid ID to delete this user account';
      return;
  }	

  session_destroy();
  setcookie('LOGGED_USER', "", time() - 3600);

  // delete the account where the id matches & user is owner, who is logged in.
  $deleteUser = $mysqlClient->prepare('DELETE FROM users WHERE user_id = :user_id AND email = :email');
  $deleteUser->execute([
    'user_id' => $user_id,
    'email' => $loggedUser['email'],
  ]);

  header('Location: '.$rootUrl.'index.php');
?>
