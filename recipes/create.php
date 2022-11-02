<?php 
  session_start(); 
  include_once('../config/user.php');
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

      <!-- Create recipe form -->
        <h1>Add A Recipe</h1>
          <form action="post_create.php" method="POST">
              <div class="mb-3">
                  <label for="title" class="form-label">Recipe Title</label>
                  <input type="title" class="form-control" id="title" name="title" aria-describedby="title-help">
                  <div id="title-help" class="form-text">Choose a title for your recipe.</div>
              </div>
              <div class="mb-3">
                  <label for="recipe" class="form-label">Recipe Description</label>
                  <textarea class="form-control" placeholder="Put recipe details here ..." id="recipe" name="recipe"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Send</button>
          </form>
          <br />
    </div>
    <!-- include footer -->
    <?php include_once('../include/footer.php'); ?>
</body>
</html>
