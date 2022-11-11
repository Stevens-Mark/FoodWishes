<?php 
  session_start();
  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $recipe_id = $_POST['id'];
  $image = $_POST['image'];
  $author = $_POST['author'];

  if (!isset($recipe_id) || (!is_numeric($recipe_id)))
  {
    echo 'You need a valid ID to delete a recipe';
      return;
  }	

  // if user is the author & uploaded a recipe image then remove from folder
  if ($image && $author == $loggedUser['email']) {
    unlink($rootPath."/recipes/images/".$image);
  }

  // delete the recipe where the id matches & user is owner, who is logged in.
  $deleteRecipe = $mysqlClient->prepare('DELETE FROM recipes WHERE recipe_id = :recipe_id AND author = :author');
  $deleteRecipe->execute([
    'recipe_id' => $recipe_id,
    'author' => $loggedUser['email'],
  ]);

  header('Location: '.$rootUrl.'index.php');
?>
