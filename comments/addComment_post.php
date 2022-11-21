<?php
  session_start(); 
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $postData = $_POST;

  if ( !isset($postData['comment']) && !isset($postData['recipe_id']) && !isset($postData['review']) 
        && !is_numeric($postData['recipe_id']) && !is_numeric($postData['recipe_id']) )
      {
        echo('The comment is invalid.');
        return;
      }

  if (!isset($loggedUser)) {
      echo('You must be logged in to submit a comment.');
      return;
  }

  $comment = $postData['comment'];
  $recipeId = $postData['recipe_id'];
  $review = $postData['review'];

  $insertComment = $mysqlClient->prepare('INSERT INTO comments(comment, recipe_id, user_id, review) VALUES (:comment, :recipe_id, :user_id, :review)');
  $insertComment->execute([
      'comment' => $comment,
      'recipe_id' => $recipeId,
      'user_id' => mailToUserId($loggedUser['email'], $users),
      'review' => (int) $review,
  ]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Creation</title>
    <meta name="author" content="Mark Stevens">
    <meta name="description" content="Built using PHP & MySQL. This is a recipe website where users can sign up & share their recipes with other users as well as comment on the recipes displayed. This page shows the comment success message the user has written about the recipe they have chosen." >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="d-flex flex-column min-vh-100">
  <main class="container">

    <?php include_once($rootPath.'/include/header.php'); ?>
      <h1 class="mb-4">Comment successfully added!</h1>
      
      <div class="card">      
        <div class="card-body">
          <p class="card-text"><b>Note</b> : <?php echo($review); ?> / 5</p>
          <p class="card-text"><b>Your comment</b> : <?php echo strip_tags($comment); ?></p>
        </div>
      </div>
  </main>
  <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>
