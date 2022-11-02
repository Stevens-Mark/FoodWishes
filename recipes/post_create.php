<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');

$postCreateData = $_POST;
$title = $postCreateData['title'];
$recipe = $postCreateData['recipe'];

// if empty recipe info, do nothing, but show error message
if ( (!isset($title) || empty($title)) || (!isset($recipe) || empty($recipe)) )
  {
    $errorMessage = 'You need a title and a recipe to submit the form';
  }	else {
    // otherwise enter recipe into database & show message
    $insertRecipe = $mysqlClient->prepare('INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
    $insertRecipe->execute([
      'title' => $title,
      'recipe'=> $recipe,
      'author' => $_SESSION['LOGGED_USER'],
      'is_enabled' => 1,
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
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
      <?php include_once('../include/header.php'); ?>

      <!-- If info entered by user not valid, show message -->
      <?php if ( (!isset($title) || empty($title)) || (!isset($recipe) || empty($recipe)) ): ?>      
          <h1>Oops !</h1> 
          <div class="card">
            <div class="card-body">
            <p class="card-title"><?php echo($errorMessage); ?></p>
            </div>
          </div>
        <? else: ?>
          <!-- otherwise display recipe information -->
          <h1>Recipe Received !</h1> 
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Your Recipe information</h2>
              <p class="card-text"><b>Title</b> : <?php echo($title); ?></p>
              <p class="card-text"><b>Recipe</b> : <?php echo strip_tags($recipe); ?></p>
            </div>
          </div>
      <?php endif; ?>   
 
    </div>
    <?php include_once('../include/footer.php'); ?>
</body>
</html>