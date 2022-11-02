<?php session_start(); 

  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/user.php");
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
    // otherwise retrieve the recipe to be deleted
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
    <title>Site de recettes - Formulaire de Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

      <!-- include header -->
      <?php include_once('../include/header.php'); ?>

      <!-- Delete recipe form -->
        <h1>Delete The Recipe</h1>
        <div class="card">
          <div class="card-body">
            <form action="post_delete.php" method="POST">
              <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Recipe ID</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($recipe_id); ?>">
              </div>
              <div class="mb-3">
                <h2><?php echo($recipe['title']); ?></h2>
                <p>Author : <i><?php echo displayAuthor($recipe['author'], $users ); ?></i></p>
              </div>
          </div>      
        </div>
              <p class="m-2"><?php echo($recipe['author'] != $_SESSION['LOGGED_USER'] ? 'Sorry, you do not have the permissions to delete this recipe !' : 'Are you sure ?' ); ?></p>
              <!-- disable delete button if user is not owner or recipe -->
              <button type="submit" class="btn btn-danger m-2" <?php echo($recipe['author'] != $_SESSION['LOGGED_USER'] ? 'disabled' : '' ); ?> >Delete</button>
            </form>
          <br />
    </div>
    <!-- include footer -->
    <?php include_once('../include/footer.php'); ?>
</body>
</html>
