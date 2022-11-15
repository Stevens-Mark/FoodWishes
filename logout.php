<?php 
  session_start(); // $_SESSION  
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');

  if(isset($_POST['logout'])) {
    session_destroy();
    setcookie('LOGGED_USER', "", time() - 3600);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
  </head>
<body class="backTwo d-flex flex-column min-vh-100">
  <main class="container">
    <!-- include header -->
    <?php include_once($rootPath.'/include/header.php'); ?>
      <div class="alert alert-success mt-2" role="alert">
        You are now logged out !
      </div>
  </main>
    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>

</body>
</html>