<?php
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");

  // session: data passed from create or update page
  $_POST = $_SESSION['recipeData'];
  $heading = $_POST['heading'];
  $title = $_POST['title'];
  $summary = $_POST['summary'];
  $duration = $_POST['duration'];
  $ingredients = $_POST['ingredients'];
  $recipe = $_POST['recipe'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success !</title>
    <meta name="author" content="Mark Stevens">
    <meta name="description" content="Built using PHP & MySQL. This is a recipe website where users can sign up & share their recipes with other users as well as comment on the recipes displayed. This page shows a sucess message when user creates or updates a recipe." >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="backThree d-flex flex-column min-vh-100">
    <main class="container">
      <?php include_once($rootPath.'/include/header.php'); ?>
      <section>
          <div class="d-flex align-items-center mb-4">
            <img class="icon-h1" src="<?php echo($rootUrl). '/assets/plateLogo.png'; ?>" alt="" >
            <h1><?php echo($heading); ?></h1>
          </div>
            <div class="card m-4">
              <div class="card-body">
                <h2 class="card-title mb-4">Your Recipe information</h2>
                <p class="card-text"><b>Title</b> : <?php echo ucfirst(strip_tags($title)); ?></p>
                <p class="card-text"><b>Description</b> : <?php echo strip_tags($summary); ?></p>
                <p class="card-text"><b>Time : </b><?php echo date("H:i", strtotime($duration)); ?> (HH:mm).</p>
                <p class="card-text"><b>Ingredients : </b><?php echo strip_tags($ingredients); ?></p>
                <p class="card-text"><b>Instructions</b> : <?php echo strip_tags($recipe); ?></p>
              </div>
            </div>
      </section>
    </main>
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>