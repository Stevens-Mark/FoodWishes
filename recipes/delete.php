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
    <title>Delete A Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="backThree d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once($rootPath.'/include/header.php'); ?>
      <section>
        <h1 class="mb-4">Delete The Recipe</h1>
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <h2><?php echo ucfirst($recipe['title']); ?></h2>
              <p class="card-text"><b>Description : </b><?php echo $recipe['summary']; ?></p>
              <p class="card-text mt-4"><b>Time : </b><?php echo date("H:i", strtotime($recipe['duration'])); ?> (HH:mm).</p>
              <p class="card-text"><b>Ingredients : </b><?php echo $recipe['ingredients']; ?></p>
              <p class="card-text"><b>Instructions : </b><?php echo $recipe['recipe']; ?></p>
              <p class="card-text"><b>Author : </b><i class="text-muted"><?php echo ucfirst(displayAuthor($recipe['author'], $users)); ?></i></p>
            </div>
          </div>      
        </div>

        <form action="post_delete.php" method="POST">
          <div class="mb-3 visually-hidden">
            <label for="id" class="form-label">Recipe ID</label>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($recipe_id); ?>">
          </div>
          <div class="mb-3 visually-hidden">
            <label for="image" class="form-label">Image Name</label>
            <input type="text" class="form-control" id="image" name="image" value="<?php echo($recipe['image']); ?>">
          </div>
          <div class="mb-3 visually-hidden">
            <label for="author" class="form-label">Recipe Author</label>
            <input type="hidden" class="form-control" id="author" name="author" value="<?php echo($recipe['author']); ?>">
          </div>
            <p class="text-danger mt-2"><?php echo($recipe['author'] != $loggedUser['email'] ? 'Sorry, you do not have the permissions to delete this recipe !' : 'This will be PERMANENT. Are you sure ?' ); ?></p>
            <!-- disable delete button if user is not owner of recipe -->
            <button type="submit" class="btn btn-danger mt-2" <?php echo($recipe['author'] != $loggedUser['email'] ? 'disabled' : '' ); ?> >Delete</button>
            <a class="btn btn-info mt-2 mx-2" href="<?php echo($rootUrl)?>recipes/read.php?id=<?php echo($recipe_id ); ?>">Cancel</a>
        </form>
        <br />
      </section>
</main>
    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>
