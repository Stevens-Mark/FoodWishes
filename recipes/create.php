<?php 
  session_start(); 
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  // define variables and set to empty/boolean values
  $title = $recipe = $summary = $duration = $ingredients = $image = $titleErr = $summaryErr = $durationErr = $ingredientsErr = $recipeErr = "";
  $extensionError = $sizeError = false;

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

    // Recipe summary/description
    if (empty($_POST["summary"])) {
      $summaryErr = "Recipe description is required.";
    } else {
      $summary = test_input($_POST["summary"]);
      // check description length minimum
      if (strlen($summary) < 20 || strlen($summary) > 500) {
        $summaryErr = "Description length between 20 and 500 characters.";
      }
    }

    // cooking duration
    if (empty($_POST["duration"])) {
      $durationErr = "Cooking Time is required.";
    } else {
      $duration = test_input($_POST["duration"]);
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

    // Recipe instructions
    if (empty($_POST["recipe"])) {
      $recipeErr = "Recipe instructions are required.";
    } else {
      $recipe = test_input($_POST["recipe"]);
      // check instructions length minimum
      if (strlen($recipe) < 20) {
        $recipeErr = "Minimum instructions length is 20 characters.";
      }
    }
  
    // Let's test if a file has been added and if so, that there are no errors
    if ( isset($_FILES['image']) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0 ) {

      // test size
      if($_FILES["image"]["size"] > 	1048576  ) { // 1 MB 
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
  
     // if id matches, recipe info (ie, no errors) & user is owner : update recipe in database & show message
    if ( empty($titleErr) && empty($summaryErr) && empty($durationErr) && empty($recipeErr) && empty($ingredientsErr) && !$extensionError && !$sizeError )   
      {
        $insertRecipe = $mysqlClient->prepare('INSERT INTO recipes(title, summary, duration, recipe, ingredients, image, author, is_enabled) VALUES (:title, :summary, :duration, :recipe, :ingredients, :image, :author, :is_enabled)');
        $insertRecipe->execute([
            'title' => $title,
            'summary' => $summary,
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
    <title>Add A Recipe</title>
    <meta name="author" content="Mark Stevens">
    <meta name="description" content="Built using PHP & MySQL. This is a recipe website where users can sign up & share their recipes with other users as well as comment on the recipes displayed. This page allows the user to create a new reipe." >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="backThree d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once($rootPath.'/include/header.php'); ?>

     <section>
        <div class="d-flex align-items-center mb-4">
          <img class="icon-h1" src="<?php echo($rootUrl). '/assets/plateLogo.png'; ?>" alt="" >
          <h1>Add A Recipe</h1>
        </div>

          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">

              <div class="mb-3 visually-hidden">
                <label for="heading" class="form-label">Create</label>
                <input type="hidden" class="form-control" id="heading" name="heading" value="Recipe Created !">
              </div>

              <div class="mb-3">
                <label for="title" class="form-label">Recipe Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Choose a title for your recipe." value="<?php echo $title;?>">
                <span class="text-danger"><?php echo $titleErr;?></span>
              </div>

              <div class="mb-3">
                <label for="summary" class="form-label">Recipe Description</label>
                <textarea rows="2" class="form-control" placeholder="Put a brief description here ..." id="summary" name="summary"><?php echo $summary;?></textarea>
                <span class="text-danger"><?php echo $summaryErr;?></span>
              </div>

              <div class="mb-3">
                <label for="duration" class="form-label">Cooking time</label>
                <input type="time" class="form-control" id="duration" name="duration" min="00:05" max="06:00" value="<?php echo $duration;?>">
                <span class="text-danger"><?php echo $durationErr;?></span>
              </div>

              <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea rows="3" class="form-control" placeholder="Put ingredients here ..." id="ingredients" name="ingredients"><?php echo $ingredients;?></textarea>
                <span class="text-danger"><?php echo $ingredientsErr;?></span>
              </div>

              <div class="mb-3">
                <label for="recipe" class="form-label">Instructions</label>
                <textarea rows="3" class="form-control" placeholder="Put recipe details here ..." id="recipe" name="recipe"><?php echo $recipe;?></textarea>
                <span class="text-danger"><?php echo $recipeErr;?></span>
              </div>
              

              <!-- File upload ! -->
              <div class="mb-3">

                  <label for="image" class="form-label">Your File <i>(optional)</i></label>
                  <input type="file" class="form-control" id="image" name="image" aria-describedby="image-help">
                  <div id="image-help" class="form-text mb-3">Upload either JPG, PNG or GIF (maximum size 1MB).</div>

                 <!-- display file upload errors if needed  -->
                <?php if(($extensionError)) : ?>
                  <p class="card-text text-danger" ><b>File Type</b> : <?php echo(" extension not allowed, please choose a JPEG, PNG or GIF file.") ?></p>
                <?php endif; ?>

                <?php if(($sizeError)) : ?>
                  <p class="card-text text-danger"><b>File Size</b> : <?php echo($_FILES["image"]["size"]) ?> bytes, but maximum size is 1 MB. </p>
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

