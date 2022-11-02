<?php session_start(); 

  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $getData = $_GET;
  $recipe_id = $getData['id'];

  // if there is no id which is a number, display an error message 
  if (!isset($recipe_id) || (!is_numeric($recipe_id)))
  {
    $errorMessage = 'Something seems to have gone wrong. Please try again.';
    echo $errorMessage;
    return;
  }	else {
    // otherwise retrieve the recipe to update
    $retrieveRecipe = $mysqlClient->prepare('SELECT * FROM `recipes` WHERE recipe_id = :recipe_id');
    $retrieveRecipe->execute([
      'recipe_id' => $recipe_id,
    ]);
    $recipe = $retrieveRecipe->fetch(PDO::FETCH_ASSOC);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Website - Update The Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

      <!-- include header -->
      <?php include_once('../include/header.php'); ?>

      <!-- Update recipe form -->
        <h1>Update The Recipe</h1>

          <form action="post_update.php" method="POST">
              <div class="mb-3 visually-hidden">
                  <label for="id" class="form-label">Recipe ID</label>
                  <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($recipe_id); ?>">
              </div>
              <div class="mb-3">
                  <label for="title" class="form-label">New Recipe Title</label>
                  <input type="title" class="form-control" id="title" name="title" aria-describedby="title-help" value="<?php echo($recipe['title']); ?>">
                  <div id="title-help" class="form-text">Choose a title for your recipe.</div>
              </div>
              <div class="mb-3">
                  <label for="recipe" class="form-label">Recipe Description</label>
                  <textarea rows="10" class="form-control" aria-describedby="description-help" id="recipe" name="recipe"><?php echo strip_tags($recipe['recipe']); ?></textarea>
                  <div id="description-help" class="form-text">Put updated recipe details here</div>
              </div>
              <button type="submit" class="btn btn-warning">Update</button>
          </form>
          <br />
    </div>

    <!-- include footer -->
    <?php include_once('../include/footer.php'); ?>

</body>
</html>
