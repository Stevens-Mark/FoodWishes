<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');

$postCreateData = $_POST;
$full_name = $postCreateData['full_name'];
$age = $postCreateData['age'];
$email = $postCreateData['email'];
$password = $postCreateData['password'];

// check if email in database
$isMail = $mysqlClient->prepare("SELECT email FROM users WHERE email = :email");
$isMail->execute(['email' => $email, ]);
$user = $isMail->fetch(PDO::FETCH_ASSOC);

// if empty user info, do nothing, but show error message
if ( (!isset($full_name) || empty($full_name)) || (!isset($age) || empty($age)) || (!isset($email) || empty($email)) || (!isset($password) || empty($password)) )
  {
    $errorMessage = 'You need to enter ALL the details to submit the form ...';
  }	
  // check email not already used & if so show error message
  else if (isset($user) && !empty($user)) 
  {
    $errorMessage = 'This email address is used already !';
  }	 
  else {
    // otherwise enter user into database & show success message
    $insertUser = $mysqlClient->prepare('INSERT INTO users(full_name, age, email, password) VALUES (:full_name, :age, :email, :password)');
    $insertUser->execute([
      'full_name' => $full_name,
      'age'=> $age,
      'email' => $email,
      'password' => $password,
    ]);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Received</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
      <?php include_once('include/header.php'); ?>

      <!-- If info entered by user not valid, show message -->
      <?php if ( (!isset($full_name) || empty($full_name)) || (!isset($age) || empty($age)) ||
      (!isset($email) || empty($email)) || (!isset($password) || empty($password)) || (isset($user) && !empty($user)) ): ?>      
          <h1>Oops !</h1> 
          <div class="card">
            <div class="card-body">
            <p class="card-title"><?php echo($errorMessage); ?></p>
            </div>
          </div>
        <? else: ?>
          <!-- otherwise display user information -->
          <h1>Recipe Received !</h1> 
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Your User information</h2>
              <p class="card-text"><b>Full Name</b> : <?php echo strip_tags($full_name); ?></p>
              <p class="card-text"><b>Age</b> : <?php echo strip_tags($age); ?></p>
              <p class="card-text"><b>Email</b> : <?php echo strip_tags($email); ?></p>
              <p class="card-text"><b>Password</b> : <?php echo strip_tags($password); ?></p>
            </div>
          </div>
      <?php endif; ?>   
 
    </div>
    <?php include_once('include/footer.php'); ?>
</body>
</html>