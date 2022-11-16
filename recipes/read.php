<?php session_start(); 

  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/user.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $getData = $_GET;
  $recipe_Id = $getData['id'];

  if (!isset($recipe_Id) && is_numeric($recipe_Id))
  {
    $errorMessage = 'Something seems to have gone wrong. Please try again.';
    echo $errorMessage;
    return;
  }	

  // retrieve recipe from recipe table & all associated comments from comment table
  $retrieveRecipeWithCommentsStatement = $mysqlClient->prepare('SELECT *, DATE_FORMAT(c.created_at, "%d/%m/%Y") as comment_date FROM recipes r LEFT JOIN comments c on r.recipe_id = c.recipe_id WHERE r.recipe_id = :recipe_id');
  $retrieveRecipeWithCommentsStatement->execute([
      'recipe_id' => $recipe_Id,
  ]);

  $recipeWithComments = $retrieveRecipeWithCommentsStatement->fetchAll(PDO::FETCH_ASSOC);

  // retieve average rating 
  $averageRatingStatment = $mysqlClient->prepare('SELECT ROUND(AVG(c.review),1) as rating FROM recipes r LEFT JOIN comments c on r.recipe_id = c.recipe_id WHERE r.recipe_id = :id');
  $averageRatingStatment->execute([
      'id' => $recipe_Id,
  ]);
  
  $averageRating = $averageRatingStatment->fetch(PDO::FETCH_ASSOC);

  $recipe = [
    'recipe_id' => $recipeWithComments[0]['recipe_id'],
    'title' => $recipeWithComments[0]['title'],
    'summary' => $recipeWithComments[0]['summary'],
    'duration' => $recipeWithComments[0]['duration'],
    'ingredients' => $recipeWithComments[0]['ingredients'],
    'recipe' => $recipeWithComments[0]['recipe'],
    'author' => $recipeWithComments[0]['author'],
    'image' => $recipeWithComments[0]['image'],
    'comments' => [],
    'rating' => $averageRating['rating'],
  ];

  // if comment table not empty then populate all comment data into recipe comment array
  foreach($recipeWithComments as $comment) {
      if (!is_null($comment['comment_id'])) {
          $recipe['comments'][] = [
              'comment_id' => $comment['comment_id'],
              'comment' => $comment['comment'],
              'user_id' => (int) $comment['user_id'],
              'created_at' => $comment['comment_date'],
              'review' => $comment['review'],
          ];
      }
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
<body class="backThree d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once($rootPath.'/include/header.php'); ?>
      <section class="readPage-container mx-auto">
        <h1 class="mb-4">Recipe</h1>

        <div class="card">
          <div class="d-flex flex-column card-body">
            <div class="d-flex flex-column-reverse flex-lg-row justify-content-between mb-3">

              <div class="readPage-summary me-2" >
                <h2 class="readPage-recipeTitle"><?php echo ucfirst($recipe['title']); ?></h2>
                <p class="card-text"><b>Author : </b><i class="text-muted"><?php echo ucfirst(displayAuthor($recipe['author'], $users)); ?></i></p>
                <p><b>Rated by the community at : </b><?php echo($recipe['rating'] ? $recipe['rating'] ." / 5" : "No rating yet"); ?></p>
                <p class="card-text mt-4"><b>Time : </b><?php echo date("H:i", strtotime($recipe['duration'])); ?> (HH:mm).</p>
              </div>

              <img class="recipe-image readPage-image rounded mb-2" src="<?php echo($rootUrl)?>/recipes/images/<?php echo $recipe['image'] ? $recipe['image'] : 'ImageDefault_NO_DELETE.png' ?>" alt="">
            </div>

              <p class="card-text"><b>Ingredients : </b><?php echo $recipe['ingredients']; ?></p>
              <p class="card-text"><b>Instructions : </b><?php echo $recipe['recipe']; ?></p>
         
          </div>      
        </div>

          <div class="mt-auto text-end">
            <a class="btn btn-warning btn-sm my-4" href="<?php echo($rootUrl)?>recipes/update.php?id=<?php echo($recipe['recipe_id']); ?>">Edit</a>
            <a class="btn btn-danger btn-sm m-2" href="<?php echo($rootUrl)?>recipes/delete.php?id=<?php echo($recipe['recipe_id']); ?>">Delete</a>
          </div>
          <!-- If there are comments then display them  -->
          <?php if(count($recipe['comments']) > 0): ?>
          <hr />
          <h2>Comments</h2>
         
              <?php foreach($recipe['comments'] as $comment): ?>
                <hr />
                <!-- display each average rating, comment & comment author  -->
                <div class="d-flex flex-wrap">
                  <p class="mb-0 pe-3"><?php echo($comment['created_at']); ?></p>
                  <p class="mb-0 pe-3"><?php echo($comment['review']); ?> Star(s)</p>
                  <p class="mb-0 pe-3" ><?php echo($comment['comment']); ?></p>
                  <p><i><?php echo(displayUser($comment['user_id'], $users)); ?></i></p>
                </div>
              <?php endforeach; ?>
        
          <?php endif; ?>
          <hr />
          <!-- include comment form  -->
          <?php include_once($rootPath.'/comments/addComment.php'); ?>
      </section>
      
</main>
    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>
