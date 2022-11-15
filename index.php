<?php 
  session_start(); // $_SESSION
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  // include_once($_SERVER['DOCUMENT_ROOT'] . '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $search = $_POST['search'] ?? null;

  if (!empty($search)) {
    $searchStatement = $mysqlClient->prepare("SELECT * FROM recipes WHERE title LIKE '%$search%' OR summary LIKE '%$search%' OR ingredients LIKE '%$search%' OR recipe LIKE '%$search%' ");
    $searchStatement->execute();
    $recipes = $searchStatement->fetchAll();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta name="author" content="Mark Stevens">
    <meta name="description" content="" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">

</head>
<body class="backOne d-flex flex-column min-vh-100">
  <main class="container">

    <!-- include header -->
    <?php include_once($rootPath.'/include/header.php'); ?>

    <!-- include log in form -->
    <?php include_once($rootPath.'/login.php'); ?>

    <!-- If the user exists, the recipes are displayed -->
    <?php if(isset($loggedUser)): ?>
      <section class="mb-4">
        <h1 class="mb-4">Recipes</h1>
        <!-- If user enters a search word & no results display message -->
        <?php if(count($recipes) <1) : ?>
          <div class="d-flex justify-content-center align-items-center" style="height:calc( 100vh - 375px );">
            <p>Sorry, there are no recipes to display ...</p>
          </div>
        <?php else: ?>
          <!-- display full recipe list or search results  -->
          <div class='recipe-container'>
            <!-- Display recipe cards - loop through the recipes up until limit-->
            <?php foreach(getRecipes($recipes, $limit) as $recipe) : ?>
              <article class="recipe-card card bg-light">
                <a class="text-decoration-none text-dark" href="<?php echo($rootUrl)?>recipes/read.php?id=<?php echo($recipe['recipe_id']); ?>">
                  <div class="card-body d-flex flex-column">
                    <img class="recipe-image rounded-top mb-2" src="<?php echo($rootUrl)?>/recipes/images/<?php echo $recipe['image'] ? $recipe['image'] : 'ImageDefault_NO_DELETE.png' ?>" alt="">
                    <h2 class="card-title"><?php echo ucfirst($recipe['title']); ?></h2>
                    <p class="card-subtitle mb-2"><b>Author : </b><i class="text-muted"><?php echo ucfirst(displayAuthor($recipe['author'], $users )); ?></i></p>
                    <p class="card-text"><b>Time : </b><?php echo date("H:i", strtotime($recipe['duration'])); ?> (HH:mm).</p>
                    <p class="card-text"><?php echo $recipe['summary']; ?></p>
                  </div>
                </a>
              </article>
            <?php endforeach ?>
          </div>

        <?php endif; ?>
      </section>
      <div class="text-end">
      <a class="btn btn-danger mb-4" href="<?php echo($rootUrl)?>destroy.php?id=<?php echo($loggedUser['email']); ?>">Delete Your Account</a></d>
    <?php endif; ?>

  </main>
  <!-- include footer -->
  <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>
