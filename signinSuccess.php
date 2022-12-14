<?php
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');

  $_POST = $_SESSION;
  $full_name = $_POST['full_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Success</title>
    <meta name="author" content="Mark Stevens">
    <meta name="description" content="Built using PHP & MySQL. This is a recipe website where users can sign up & share their recipes with other users as well as comment on the recipes displayed. This page displays asign up success message." >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="backOne d-flex flex-column min-vh-100">
    <main class="container">
      <?php include_once($rootPath.'/include/header.php'); ?>
      <section>
        <div class="d-flex align-items-center mb-4">
          <img class="icon-h1" src="<?php echo($rootUrl). '/assets/plateLogo.png'; ?>" alt="" >
          <h1>Congratulations !</h1>
        </div>
        <div class="card">
          <div class="card-body">
          <p class="card-title"><?php echo ucfirst($full_name); ?>, your account has been created. You can now log in to the website ...</p>
          </div>
        </div>
      </section>
    </main>
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>