<?php session_start(); // $_SESSION ?> 

<?php
  if(isset($_POST['logout'])) {
    session_destroy();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
  <div class="container">
    <!-- include header -->
    <?php include_once('include/header.php'); ?>
      <div class="alert alert-success" role="alert">
        You are now logged out !
    </div>
  </div>
    <!-- include footer -->
    <?php include_once('include/footer.php'); ?>

</body>
</html>