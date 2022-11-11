<?php 
  session_start(); 
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  // define variables and set to empty/boolean values
  $title = $recipe = $duration = $ingredients = $image = $titleErr = $durationErr = $ingredientsErr = $recipeErr  = "";
  $titleFail = $recipeFail = $ingredientsFail = $durationFail = false;
  $extensionError = $sizeError = false;

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

    // cooking duration
    if (empty($_POST["duration"])) {
      $durationErr = "Cooking Time is required.";
      $durationFail = true;
    } else {
      $duration = test_input($_POST["duration"]);
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

    // Recipe ingredients
    if (empty($_POST["ingredients"])) {
      $ingredientsErr = "Ingredients are required.";
      $ingredientsFail = true;
    } else {
      $ingredients = test_input($_POST["ingredients"]);
      // check description length minimum
      if (strlen($ingredients) < 10) {
        $ingredientsErr = "Minimum ingredients length is 10 characters.";
        $ingredientsFail = true;
      }
    }
    
    // Let's test if a file has been added and if so, that there are no errors
    if ( isset($_FILES['image']) && !empty($_FILES['image']) ) {

      // test size
      if($_FILES["image"]["size"] > 2097152 ) { // 2 MB 
        $sizeError = true;
      }

      // test if extension is allowed
      $fileInfo = pathinfo($_FILES['image']['name']);
      $extension = $fileInfo['extension'] ?? null;
      $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
      if(!in_array(strtolower($extension), $allowedExtensions)) {
        $extensionError = true;
      }
 
      // no errors? validate the file and store it temporarily with a unique name
      if(!($extensionError) && !($sizeError)) {
        $uploadedFile = str_replace(' ', '_', $_FILES['image']['name']);
        $pieces = explode(".", $uploadedFile);
        $image = $pieces[0] .'.'.uniqid() . '.' . $pieces[1];
        move_uploaded_file(
          $_FILES['image']['tmp_name'],
          'images/' . $image);
      }
    }
  
    // if recipe info ok, enter into database & show success message
    if ( !$titleFail && !$durationFail && !$recipeFail && !$ingredientsFail && !$extensionError && !$sizeError )
      {
        $insertRecipe = $mysqlClient->prepare('INSERT INTO recipes(title, duration, recipe, ingredients, image, author, is_enabled) VALUES (:title, :duration, :recipe, :ingredients, :image, :author, :is_enabled)');
        $insertRecipe->execute([
            'title' => $title,
            'duration' => $duration,
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'image' => $image,
            'author' => $loggedUser['email'],
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once($rootPath.'/include/header.php'); ?>

      <section>
        <h1 class="mb-4">Add A Recipe</h1>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
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
                  <label for="duration" class="form-label">Cooking time</label>
                  <input type="time" class="form-control" id="duration" name="duration" min="00:05" max="06:00" value="<?php echo $duration;?>">
                  <span class="text-danger"><?php echo $durationErr;?></span>
              </div>
              <div class="mb-3">
                  <label for="ingredients" class="form-label">Ingredients</label>
                  <textarea rows="3"  class="form-control" id="ingredients" name="ingredients" placeholder="Put ingredients here ..."><?php echo $ingredients;?></textarea>
                  <span class="text-danger"><?php echo $ingredientsErr;?></span>
              </div>
              <div class="mb-3">
                  <label for="recipe" class="form-label">Recipe Description</label>
                  <textarea rows="6"  class="form-control"  id="recipe" name="recipe" placeholder="Put recipe details here ..."><?php echo $recipe;?></textarea>
                  <span class="text-danger"><?php echo $recipeErr;?></span>
              </div>
              <!-- File upload ! -->
              <div class="mb-3">
                  <label for="image" class="form-label">Your File <i>(optional)</i></label>
                  <input type="file" class="form-control" id="image" name="image" aria-describedby="image-help">
                  <div id="image-help" class="form-text mb-3">Upload either JPG, PNG or GIF (maximum size 2MB).</div>
                 <!-- display file upload errors if needed  -->
                <?php if(($extensionError)) : ?>
                  <p class="card-text text-danger" ><b>File Type</b> : <?php echo(" extension not allowed, please choose a JPEG, PNG or GIF file.") ?></p>
                <?php endif; ?>
                <?php if(($sizeError)) : ?>
                  <p class="card-text text-danger"><b>File Size</b> : <?php echo($_FILES["image"]["size"]) ?> bytes, but maximum size is 2 MB. </p>
                <?php endif; ?>
              </div>
              <button type="submit" class="btn btn-primary">Send</button>
          </form>
          <br />
      </section>     
    </main>
    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>
