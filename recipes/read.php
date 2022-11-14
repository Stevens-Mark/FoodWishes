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
    <title>Chosen Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once($rootPath.'/include/header.php'); ?>
      <section class="readPage-container mx-auto">
        <h1 class="mb-4">Recipe</h1>

        <div class="card">
          <div class="d-flex flex-column card-body">
            <div class="d-flex flex-column-reverse flex-lg-row justify-content-between mb-3">

              <div class="me-2" >
                <h2><?php echo ucfirst($recipe['title']); ?></h2>
                <p class="card-text"><b>Author : </b><i class="text-muted"><?php echo ucfirst(displayAuthor($recipe['author'], $users)); ?></i></p>
                <p class="card-text mt-4"><b>Time : </b><?php echo date("H:i", strtotime($recipe['duration'])); ?> (HH:mm).</p>
              </div>

              <img class="recipe-image readPage-image rounded mb-2" src="<?php echo($rootUrl)?>/recipes/images/<?php echo $recipe['image'] ? $recipe['image'] : 'ImageDefault_NO_DELETE.png' ?>" alt="">
            </div>

              <p class="card-text"><b>Ingredients : </b><?php echo $recipe['ingredients']; ?></p>
              <p class="card-text"><b>Instructions : </b><?php echo $recipe['recipe']; ?></p>
         
          </div>      
        </div>

          <div class="mt-auto">
            <a class="btn btn-warning btn-sm my-4" href="<?php echo($rootUrl)?>recipes/update.php?id=<?php echo($recipe['recipe_id']); ?>">Edit</a>
            <a class="btn btn-danger btn-sm m-2" href="<?php echo($rootUrl)?>recipes/delete.php?id=<?php echo($recipe['recipe_id']); ?>">Delete</a>
          </div>

      </section>
</main>
    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>
