<?php session_start(); // $_SESSION
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Website - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

</head>
<body class="d-flex flex-column min-vh-100">
  <main class="container">

      <!-- include header -->
      <?php include_once('include/header.php'); ?>

      <!-- include log in form -->
      <?php include_once('login.php'); ?>

      <!-- If the user exists, the recipes are displayed -->
      <?php if(isset($loggedUser)): ?>
        <section>
          <h1 class="mb-4">Recipes</h1>
          <div class='recipe-container'>
                <!-- Display recipe cards - loop through the recipes up until limit-->
                <?php foreach(getRecipes($recipes, $limit) as $recipe) : ?>

                  <article class="recipe-card card bg-light">
                    <div class="card-body d-flex flex-column">
                      <h2 class="card-title"><?php echo $recipe['title']; ?></h2>
                      <p class="card-subtitle mb-2 text-muted"><i><?php echo displayAuthor($recipe['author'], $users ); ?></i></p>
                      <p class="card-text"><?php echo $recipe['recipe']; ?></p>
                      <div class="mt-auto">
                      <a class="btn btn-warning btn-sm my-2" href="<?php echo($rootUrl)?>recipes/update.php?id=<?php echo($recipe['recipe_id']); ?>">Edit</a>
                      <a class="btn btn-danger btn-sm m-2" href="<?php echo($rootUrl)?>recipes/delete.php?id=<?php echo($recipe['recipe_id']); ?>">Delete</a>
                      </div>
                    </div>
                  </article>
                <?php endforeach ?>
            </div>
        
          <!-- log out button -->
          <?php include_once('include/logoutButton.php'); ?>
        </section>
      <?php endif; ?>
    

  </main>
  
  <!-- include footer -->
  <?php include_once('include/footer.php'); ?>

</body>
</html>
