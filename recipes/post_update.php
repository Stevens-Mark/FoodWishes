<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');

$postData = $_POST;
$recipe_id = $postData['id'];
$title = $postData['title'];
$recipe = $postData['recipe'];

// if recipe info missing, do nothing, but show error message
if ( !isset($recipe_id) || (!isset($title) || empty($title)) || (!isset($recipe) || empty($recipe)) )
  {
    $errorMessage = 'Some information to update the recipe is missing';
  }	else {
    // otherwise update recipe in database & show message
    $insertRecipe = $mysqlClient->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :recipe_id');  
    $insertRecipe->execute([
      'title' => $title,
      'recipe'=> $recipe,
      'recipe_id' => $recipe_id,
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
          <!-- otherwise display updated recipe information -->
          <h1>Recipe Updated !</h1> 
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Your Updated Recipe information</h2>
              <p class="card-text"><b>Title</b> : <?php echo($title); ?></p>
              <p class="card-text"><b>Recipe</b> : <?php echo strip_tags($recipe); ?></p>
            </div>
          </div>
      <?php endif; ?>    
    </div>
    <?php include_once('../include/footer.php'); ?>
</body>
</html>