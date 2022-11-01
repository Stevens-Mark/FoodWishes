<?php session_start();

// load all data to be used 
include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");

$recipe_id = $_POST['id'];

if (!isset($recipe_id) || (!is_numeric($recipe_id)))
{
	echo 'You need a valid ID to delete a recipe';
    return;
}	

$deleteRecipe = $mysqlClient->prepare('DELETE FROM recipes WHERE recipe_id = :recipe_id');
$deleteRecipe->execute([
  'recipe_id' => $recipe_id,
]);

header('Location: '.$rootUrl.'index.php');
?>
