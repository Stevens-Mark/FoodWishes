<?php session_start();

// load all data to be used 
include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");

$recipe_id = $_POST['id'];

if (!isset($recipe_id) || (!is_numeric($recipe_id)))
{
	echo 'You need a valid ID to delete a recipe';
    return;
}	

// delete the recipe where the id matches & user is owner, who is logged in.
$deleteRecipe = $mysqlClient->prepare('DELETE FROM recipes WHERE recipe_id = :recipe_id AND author = :author');
$deleteRecipe->execute([
  'recipe_id' => $recipe_id,
  'author' => $loggedUser['email'],
]);

header('Location: '.$rootUrl.'index.php');
?>


<!-- // EXAMPLE 3
  // $sqlQuery ="SELECT * FROM `recipes` WHERE author = :author AND is_enabled = :is_enabled";
  // $recipesStatement = $db->prepare($sqlQuery);
  // $recipesStatement->execute([
  //   'author' => $_SESSION['LOGGED_USER'],
  //   'is_enabled' => true,
  // ]);

  // $recipes = $recipesStatement->fetchAll(); -->