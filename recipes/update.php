<?php 
  session_start(); 
  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");
  
  // define variables
  $titleErr = $recipeErr  = "";
  $titleFail = $recipeFail  = false;

  $getData = $_GET;
  $recipe_id = $getData['id'] ?? $_POST["id"];

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

  // form validation
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recipe title
    if (empty($_POST["title"])) {
      $titleErr = "Recipe title is required.";
      $titleFail = true;
    } else {
      $title = test_input($_POST["title"]);
      // check title length & only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $title)  || strlen($title) < 2) {
        $titleErr = "Minimum length is 2 characters & only letters and white space allowed.";
        $titleFail = true;
      }
    }

    // Recipe description
    if (empty($_POST["recipe"])) {
      $recipeErr = "Recipe description is required.";
      $recipeFail = true;
    } else {
      $recipe = test_input($_POST["recipe"]);
      // check description length minimum
      if (strlen($recipe) < 20) {
        $recipeErr = "Minimum description length is 20 characters.";
        $recipeFail = true;
      }
    }
  
  // if recipe info ok, update recipe in database & show message
  if ( !$titleFail && !$recipeFail )
    {
      $insertRecipe = $mysqlClient->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :recipe_id');  
      $insertRecipe->execute([
          'title' => $title,
          'recipe'=> $recipe,
          'recipe_id' => $recipe_id,
        ]);
      
      // Assign the _POST data to the _SESSION so can pass data to redirected page
      $_SESSION['recipeData']  = $_POST;
      session_write_close();

      header('Location: '.$rootUrl.'recipes/success.php');
      exit();
    }
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once('../include/header.php'); ?>

        <section>
          <h1 class="mb-4">Update The Recipe</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="mb-3 visually-hidden">
                    <label for="heading" class="form-label">Update</label>
                    <input type="hidden" class="form-control" id="heading" name="heading" value="Recipe Updated !">
                </div>
                <div class="mb-3 visually-hidden">
                    <label for="id" class="form-label">Recipe ID</label>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($recipe_id); ?>">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">New Recipe Title</label>
                    <input type="title" class="form-control" id="title" name="title" placeholder="Your New Recipe Title" aria-describedby="title-help" value="<?php echo($recipe['title']); ?>">
                    <div id="title-help" class="form-text">Choose a new title for your recipe.</div>
                    <span class="text-danger"><?php echo $titleErr;?></span>
                </div>
                <div class="mb-3">
                    <label for="recipe" class="form-label">Recipe Description</label>
                    <textarea rows="10" class="form-control" aria-describedby="description-help" id="recipe" placeholder="Put new recipe details here ..."name="recipe"><?php echo strip_tags($recipe['recipe']); ?></textarea>
                    <span class="text-danger"><?php echo $recipeErr;?></span>
                    <div id="description-help" class="form-text">Put updated recipe details here</div>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
            <br />
        </section>
    </main>

    <!-- include footer -->
    <?php include_once('../include/footer.php'); ?>

</body>
</html>
