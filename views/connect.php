<?php
  include_once('../variables/variables.php');

  // try to connect to database & if not throw error
  try
    {
      $db = new PDO(  // Often this object is identified by the variable $conn or $db
        'mysql:host=localhost;
        dbname=we_love_food;
        charset=utf8',
        'root',
        'root',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
      );
    }
    catch (Exception $e)
    {
        die('Error: ' . $e->getMessage());
    }


    // Validation, or not, of login info entered by user...
  if (isset($_POST['email']) &&  isset($_POST['password'])) {
      foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
          // if user found, save the user's email in session
          $_SESSION['LOGGED_USER'] = $user['email'];
        
        } else {
          // otherwise display error message
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s / %s)',
              $_POST['email'],
              $_POST['password']
            );
        }
      }
  }
?>