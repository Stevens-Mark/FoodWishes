<?php session_start(); // $_SESSION

  include_once('connect.php');

  // If all goes well, we can continue & retrieve contents of the recipes table

  // EXAMPLE 1
  
  // $sqlQuery = 'SELECT titlee FROM recipes';
  $sqlQuery = 'SELECT * FROM recipes WHERE is_enabled = TRUE';
  $recipesStatement = $db->prepare($sqlQuery);
  $recipesStatement->execute();

  // EXAMPLE 2
  // $sqlQuery ="SELECT * FROM `recipes` WHERE author = ?";
  // $recipesStatement = $db->prepare($sqlQuery);
  // $recipesStatement->execute([$_SESSION['LOGGED_USER']]);

  // EXAMPLE 3
  // $sqlQuery ="SELECT * FROM `recipes` WHERE author = :author AND is_enabled = :is_enabled";
  // $recipesStatement = $db->prepare($sqlQuery);
  // $recipesStatement->execute([
  //   'author' => $_SESSION['LOGGED_USER'],
  //   'is_enabled' => true,
  // ]);

  $recipes = $recipesStatement->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
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

      <h1>Site de recettes</h1>

      <!-- Inclusion du formulaire de connexion -->
      <?php include_once('login.php'); ?>

      <!-- include variables & functions -->
      <?php
          include_once('../variables/variables.php');
          include_once('../functions/functions.php');
      ?>

      <!-- If the user exists, the recipes are displayed -->
      <?php if(isset($_SESSION['LOGGED_USER'])): ?>
        <!-- Display recipe cards - loop through the recipes -->
        <?php foreach($recipes as $recipe) : ?>
              <!-- if key exists & the value is true, dislay card -->
              <!-- <php if (array_key_exists('is_enabled', $recipe) && $recipe['is_enabled'] == true): ?> -->

                <article>
                    <h3><?php echo $recipe['title']; ?></h3>
                    <div><?php echo $recipe['recipe']; ?></div>
                    <i><?php echo $recipe['author']; ?></i>
                </article>

              <!-- <php endif; ?> -->
        <?php endforeach ?>
        <!-- log out button -->
        <?php include_once('include/logoutButton.php'); ?>
      <?php endif; ?>
  </div>
  
    <!-- include footer -->
    <?php include_once('include/footer.php'); ?>

  <!-- bootstrap script needed here so navbar toggle functionality will work -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>