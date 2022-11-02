<?php 
  session_start(); 
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
          <form action="post_signin.php" method="POST">
          <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" autocomplete="full_name" aria-describedby="full_name-help" placeholder="John Doe">
            <div id="full_name-help" class="form-text">Enter your full name.</div>
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" autocomplete="age" aria-describedby="age-help" placeholder="xx years">
            <div id="age-help" class="form-text">Enter your age in years.</div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" autocomplete="username" aria-describedby="email-help" placeholder="you@example.com">
          <div id="email-help" class="form-text">The email to create the account.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password">
          </div>
        <button type="submit" class="btn btn-primary">Send</button>
          </form>
          <br />
    </div>
    <!-- include footer -->
    <?php include_once('include/footer.php'); ?>
</body>
</html>
