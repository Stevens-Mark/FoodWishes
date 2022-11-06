<?php 
  session_start(); 
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  // define variables and set to empty/boolean values
  $full_name = $email = $age = $password = $confirmPassword  = "";
  $full_nameErr = $emailErr = $ageErr = $passwordErr = $confirmPasswordErr = "";
  $full_nameFail = $emailFail = $ageFail = $passwordFail = $confirmPasswordFail = false;

  // form validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // name
  if (empty($_POST["full_name"])) {
    $full_nameErr = "Name is required.";
    $full_nameFail = true;
  } else {
    $full_name = test_input($_POST["full_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$full_name)) {
      $full_nameErr = "Only letters and white space allowed.";
      $full_nameFail = true;
    }
  }

  // age
  if (empty($_POST["age"])) {
    $ageErr = "Age is required.";
    $ageFail = true;
  } else {
    $age = test_input($_POST["age"]);
    if ($age < 16 || $age > 100) {
      $ageErr = 'Enter a valid age.';
      $ageFail = true;
    }
  }

   // email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required.";
    $emailFail = true;
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format.";
      $emailFail = true;
    }
    
    // check if email in database already
    $email =  test_input($_POST["email"]);
    $isMail = $mysqlClient->prepare("SELECT email FROM users WHERE email = :email");
    $isMail->execute(['email' => $email, ]);
    $user = $isMail->fetch(PDO::FETCH_ASSOC);
    if (isset($user) && !empty($user)) {
      $emailErr = 'This email address is in use already !';
      $email = '';
      $emailFail = true;
    }
  }

  // password
  if (empty($_POST["password"])) {
    $passwordErr = " Password is required.";
    $passwordFail = true;
  } else {
    // Validate password strength
    $password = test_input($_POST["password"]);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialchars = preg_match('@[^\w]@', $password);
    if (!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8) {
    $passwordErr = "Password is not strong enough.";
    $passwordFail = true;
  }
  // confirm password
  if (empty($_POST["confirmPassword"])) {
    $confirmPasswordErr = "A confirmation Password is required.";
    $confirmPasswordFail = true;
  } else {
    $confirmPassword = test_input($_POST["confirmPassword"]);
    if ($password != $confirmPassword ) {
      $confirmPasswordErr = "The passwords don't match.";
      $confirmPasswordFail = true;
    }
  }
}

   // if all data correct: enter user into database & show success message
  if ( !$full_nameFail && !$emailFail && !$ageFail && !$passwordFail && !$confirmPasswordFail ) 
  {
     $insertUser = $mysqlClient->prepare('INSERT INTO users(full_name, age, email, password) VALUES (:full_name, :age, :email, :password)');
    $insertUser->execute([
      'full_name' => $full_name,
      'age'=> $age,
      'email' => $email,
      'password' => $password,
    ]);

    // Assign the _POST data to the _SESSION so can pass data to redirected page using header.
    $_SESSION = $_POST;
    session_write_close();

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

      <section>
        <h1>Sign Up</h1>
              <!-- Create account form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
          
          <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" autocomplete="full_name" aria-describedby="full_name-help" placeholder="John Doe" value="<?php echo $full_name;?>">
            <div id="full_name-help" class="form-text">Enter your full name.</div>
            <span class="text-danger"><?php echo $full_nameErr;?></span>
              </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" autocomplete="age" aria-describedby="age-help" placeholder=".." value="<?php echo $age;?>">
            <div id="age-help" class="form-text">Enter your age in years (between 16 and 100).</div>
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
            <input type="password" class="form-control" id="password" name="password" aria-describedby="password-help" placeholder="........">
            <div id="password-help" class="form-text">At least 8 characters, 1 upper case, 1 lower case & 1 number.</div>
            <span class="text-danger"><?php echo $passwordErr;?></span>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="confirm-help" placeholder="........">
            <div id="confirm-help" class="form-text">Re-type the same password as above.</div> 
            <span class="text-danger"><?php echo $confirmPasswordErr;?></span>
          </div>
          
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
        <br />
      </section>
    </div>
    <!-- include footer -->

    <?php include_once('include/footer.php'); ?>
</body>
</html>
