<?php session_start(); // $_SESSION
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
  <div class="container">

    <!-- include header -->
    <?php include_once('include/header.php'); ?>

      <h1>Recipes</h1>

      <!-- Inclusion du formulaire de connexion -->
      <?php include_once('login.php'); ?>

      <!-- If the user exists, the recipes are displayed -->
      <?php if(isset($loggedUser)): ?>
        <!-- Display recipe cards - loop through the recipes up until limit-->
        <?php foreach(getRecipes($recipes, $limit) as $recipe) : ?>
                <article class="my-4">
                    <h3><?php echo $recipe['title']; ?></h3>
                    <div><?php echo $recipe['recipe']; ?></div>
                    <i><?php echo displayAuthor($recipe['author'], $users ); ?></i>
                    <div>
                      <a class="btn btn-warning my-2" href="<?php echo($rootUrl)?>recipes/update.php?id=<?php echo($recipe['recipe_id']); ?>">Edit</a>
                      <a class="btn btn-danger m-2" href="<?php echo($rootUrl)?>recipes/delete.php?id=<?php echo($recipe['recipe_id']); ?>">Delete</a>
                    </div>
                </article>
        <?php endforeach ?>
        <!-- log out button -->
        <?php include_once('include/logoutButton.php'); ?>
      <?php endif; ?>
  </div>
  
    <!-- include footer -->
    <?php include_once('include/footer.php'); ?>

</body>
</html>