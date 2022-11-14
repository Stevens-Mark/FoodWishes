<?php 
  session_start(); 
  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");
  
  // define variables
  $titleErr = $durationErr = $recipeErr = $ingredientsErr ="";
  $extensionError = $sizeError = $fileUploaded = false;

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
    $recipes = $retrieveRecipe->fetch(PDO::FETCH_ASSOC);
  }

  // form validation
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recipe title
    if (empty($_POST["title"])) {
      $titleErr = "Recipe title is required.";
    } else {
      $title = test_input($_POST["title"]);
      // check title length & only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $title)  || strlen($title) < 2) {
        $titleErr = "Minimum of 2 characters & only letters and white space allowed.";
      }
    }

    // cooking duration
    if (empty($_POST["duration"])) {
      $durationErr = "Cooking Time is required.";
    } else {
      $duration = test_input($_POST["duration"]);
    }

    // Recipe description
    if (empty($_POST["recipe"])) {
      $recipeErr = "Recipe description is required.";
    } else {
      $recipe = test_input($_POST["recipe"]);
      // check description length minimum
      if (strlen($recipe) < 20) {
        $recipeErr = "Minimum description length is 20 characters.";
      }
    }

    // Recipe ingredients
    if (empty($_POST["ingredients"])) {
      $ingredientsErr = "Ingredients are required.";
    } else {
      $ingredients = test_input($_POST["ingredients"]);
      // check description length minimum
      if (strlen($ingredients) < 10) {
        $ingredientsErr = "Minimum ingredients length is 10 characters.";
      }
    }

    // Let's test if a file has been added and if so, that there are no errors
    if ( isset($_FILES['image']) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0){
      
      // test size
      if($_FILES["image"]["size"] > 2097152 ) { // 2 MB 
        $sizeError = true;
      }

      // test if extension is allowed
      $fileInfo = pathinfo($_FILES['image']['name']);
      debug_to_console($fileInfo);
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
        $fileUploaded = true;
      }
    } else {
      $image = $recipes['image'];
    }

    // if id matches, recipe info (ie, no errors) & user is owner : update recipe in database & show message
    if ( empty($titleErr) && empty($durationErr) && empty($recipeErr) && empty($ingredientsErr) && !$extensionError && !$sizeError )
      {

        // if new uploaded file , user is author then first remove old image from folder
        if ($fileUploaded && $recipes['image'] && $recipes['author'] == $loggedUser['email']) {
          unlink($rootPath."/recipes/images/".$recipes['image']);
        }
      
        $insertRecipe = $mysqlClient->prepare('UPDATE recipes SET title = :title, duration = :duration, recipe = :recipe, ingredients = :ingredients, image = :image WHERE recipe_id = :recipe_id AND author = :author');  
        $insertRecipe->execute([
            'recipe_id' => $recipe_id,
            'title' => $title,
            'duration' => $duration,
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'image' => $image,
            'author' => $loggedUser['email'],
          ]);
        
        // Assign the _POST data to the _SESSION so can pass data to redirected page
        $_SESSION['recipeData'] = $_POST;
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
      <?php include_once($rootPath.'/include/header.php'); ?>

        <section>
          <h1 class="mb-4">Update The Recipe</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
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
                  <input type="title" class="form-control" id="title" name="title" placeholder="Your new recipe title" aria-describedby="title-help" value="<?php echo strip_tags($recipes['title']); ?>">
                  <div id="title-help" class="form-text">Choose a new title for your recipe (min 2 letters).</div>
                  <span class="text-danger"><?php echo $titleErr;?></span> 
                </div>
                <div class="mb-3">
                  <label for="duration" class="form-label">Cooking time</label>
                  <input type="time" class="form-control" id="duration" name="duration" min="00:05" max="06:00" value="<?php echo ($recipes['duration']); ?>">
                  <span class="text-danger"><?php echo $durationErr;?></span>
                </div>
                <div class="mb-3">
                  <label for="ingredients" class="form-label">Ingredients</label>
                  <textarea rows="3"  class="form-control" id="ingredients" name="ingredients" placeholder="Put new ingredients here ..." aria-describedby="ingredients-help"><?php echo strip_tags($recipes['ingredients']); ?></textarea>
                  <div id="ingredients-help" class="form-text">Put updated ingredients details here (min 10 characters).</div>
                  <span class="text-danger"><?php echo $ingredientsErr;?></span>
                </div>
                <div class="mb-3">
                  <label for="recipe" class="form-label">Recipe Description</label>
                  <textarea rows="6" class="form-control" id="recipe" name="recipe" placeholder="Put new recipe details here ..."  aria-describedby="description-help"><?php echo strip_tags($recipes['recipe']); ?></textarea>
                  <div id="description-help" class="form-text">Put updated recipe details here (min 20 characters).</div>
                  <span class="text-danger"><?php echo $recipeErr;?></span>
                </div>
                 <!-- File upload ! -->
                <div class="mb-3">
                    <label for="image" class="form-label">New recipe Image <i>(optional)</i></label>
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
                <p class="text-danger mt-4 mb-0"><b>IMPORTANT : </b> If any fields are completed incorrectly, then ALL the fields will be reset to original content !</p>
                  <p class="text-danger"><?php echo($recipes['author'] != $loggedUser['email'] ? 'Sorry, you do not have the permissions to update this recipe !' : 'Are you sure ?' ); ?></p>
                  <!-- disable button if user is not owner of recipe -->
                  <button type="submit" class="btn btn-warning mt-2" <?php echo($recipes['author'] != $loggedUser['email'] ? 'disabled' : '' ); ?> >Update</button>
                  <a class="btn btn-info mt-2 mx-2" href="<?php echo($rootUrl)?>recipes/read.php?id=<?php echo($recipe_id ); ?>">Cancel</a>
            </form>
            <br />
        </section>
    </main>

    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>

</body>
</html>
