<?php 
  session_start(); 
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  // define variables and set to empty values
  $full_name = $email = $password = $age = "";
  $full_nameErr = $emailErr = $ageErr = $passwordErr = "";

  // form validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["full_name"])) {
    $full_nameErr = "Name is required";
  } else {
    $full_name = test_input($_POST["full_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$full_name)) {
      $full_nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["age"])) {
    $ageErr = "Age is required";
  } else {
    $age = test_input($_POST["age"]);
   }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
    
    // check if email in database already
    $email =  test_input($_POST["email"]);
    $isMail = $mysqlClient->prepare("SELECT email FROM users WHERE email = :email");
    $isMail->execute(['email' => $email, ]);
    $user = $isMail->fetch(PDO::FETCH_ASSOC);
    if (isset($user) && !empty($user)) {
      $emailErr = 'This email address is used already !';
      $email = '';
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }
   // if all data correct: enter user into database & show success message
  if ( 
    ( isset($full_name) && !empty($full_name) ) && 
    ( isset($age) && !empty($age) ) && 
    ( (isset($email) && !empty($email)) ) && 
    ( isset($password) && !empty($password) ) 
    )
  {
     $insertUser = $mysqlClient->prepare('INSERT INTO users(full_name, age, email, password) VALUES (:full_name, :age, :email, :password)');
    $insertUser->execute([
      'full_name' => $full_name,
      'age'=> $age,
      'email' => $email,
      'password' => $password,
    ]);

    header('Location: '.$rootUrl.'signinSuccess.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Website - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

      <!-- include header -->
      <?php include_once('include/header.php'); ?>

      <!-- Create account form -->
      <h1>Sign Up</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
          
          <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" autocomplete="full_name" aria-describedby="full_name-help" placeholder="John Doe" value="<?php echo $full_name;?>">
            <div id="full_name-help" class="form-text">Enter your full name.</div>
            <span class="text-danger"><?php echo $full_nameErr;?></span>
              </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" autocomplete="age" aria-describedby="age-help" placeholder="xx years" value="<?php echo $age;?>">
            <div id="age-help" class="form-text">Enter your age in years.</div>
            <span class="text-danger"><?php echo $ageErr;?></span>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" autocomplete="email" aria-describedby="email-help" placeholder="you@example.com" value="<?php echo $email;?>">
          <div id="email-help" class="form-text">Enter a valid email address.</div>
          <span class="text-danger"><?php echo $emailErr;?></span>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password">
            <span class="text-danger"><?php echo $passwordErr;?></span>
          </div>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
        <br />
    </div>
    <!-- include footer -->

    <?php include_once('include/footer.php'); ?>
</body>
</html>
