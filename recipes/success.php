<?php
session_start();
$_POST = $_SESSION['recipeData'];
$heading = $_POST['heading'];
$title = $_POST['title'];
$recipe = $_POST['recipe'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success !</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
      <?php include_once('../include/header.php'); ?>
      <section>
            <h1><?php echo($heading); ?></h1> 
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Your Recipe information</h2>
                <p class="card-text"><b>Title</b> : <?php echo strip_tags($title); ?></p>
                <p class="card-text"><b>Recipe</b> : <?php echo strip_tags($recipe); ?></p>
              </div>
            </div>
      </section>
    </div>
    <?php include_once('../include/footer.php'); ?>
</body>
</html>