<?php 
  session_start(); 
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  // define variables and set to empty/boolean values
  $title = $recipe  = $titleErr = $recipeErr  = "";
  $titleFail = $recipeFail  = false;

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
      // check description lengthminimum
      if (strlen($recipe) < 25) {
        $recipeErr = "Minimum description length is 25 characters.";
        $recipeFail = true;
      }
    }
  
  // if recipe info ok, enter into database & show success message
  if ( !$titleFail && !$recipeFail )
    {
      $insertRecipe = $mysqlClient->prepare('INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
      $insertRecipe->execute([
        'title' => $title,
        'recipe'=> $recipe,
        'author' => $_SESSION['LOGGED_USER'],
        'is_enabled' => 1,
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
    <title>Recipe Website - Add A Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

      <!-- include header -->
      <?php include_once('../include/header.php'); ?>

      <section>
        <h1>Add A Recipe</h1>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
              <div class="mb-3 visually-hidden">
                <label for="heading" class="form-label">Create</label>
                <input type="hidden" class="form-control" id="heading" name="heading" value="Recipe Created !">
              </div>
              <div class="mb-3">
                  <label for="title" class="form-label">Recipe Title</label>
                  <input type="title" class="form-control" id="title" name="title" placeholder="Choose a title for your recipe." value="<?php echo $title;?>">
                  <span class="text-danger"><?php echo $titleErr;?></span>
              </div>
              <div class="mb-3">
                  <label for="recipe" class="form-label">Recipe Description</label>
                  <textarea rows="10"  class="form-control" placeholder="Put recipe details here ..." id="recipe" name="recipe"><?php echo $recipe;?></textarea>
                  <span class="text-danger"><?php echo $recipeErr;?></span>
              </div>
              <button type="submit" class="btn btn-primary">Send</button>
          </form>
          <br />
      </section>     
    </div>
    <!-- include footer -->
    <?php include_once('../include/footer.php'); ?>
</body>
</html>
