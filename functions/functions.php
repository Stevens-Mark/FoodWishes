<?php

// function to log to console for debugging
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);
  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

// replaces authors email with their name in recipe when displayed
function displayAuthor(string $authorEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . ' (' . $author['age'] . ' ans)';
        }
    }
    return 'unknown user';
}

// display username (no age) for welcome message
function displayName(string $authorEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'];
        }
    }
    return 'unknown user';
}

// display user based on user-Id
function displayUser(int $userId, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $user = $users[$i];
        if ($userId === (int) $user['user_id']) {
            return $user['full_name'] . ' (' . $user['age'] . ' ans)';
        }
    }
    return 'unknown use';
} 

// get user_Id from email address for comments storing
function mailToUserId(string $userEmail, array $users) : int
{
    for ($i = 0; $i < count($users); $i++) {
        $user = $users[$i];
        if ($userEmail === $user['email']) {
            return $user['user_id'];
        }
    }
    return 0;
}

function getRecipes(array $recipes, int $limit) : array
{
    $valid_recipes = [];
    $counter = 0;

    foreach($recipes as $recipe) {
        if ($counter == $limit) {
            return $valid_recipes;
        }
        $valid_recipes[] = $recipe;
        $counter++;
    }
    return $valid_recipes;
}

// clean up input data by user
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function displayRecipe(array $recipe) : string
{
    $recipe_content = '';

    if ($recipe['is_enabled']) {
        $recipe_content = '<article>';
        $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
        $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
        $recipe_content .= '<i>' . $recipe['author'] . '</i>';
        $recipe_content .= '</article>';
    }
    
    return $recipe;
}

// // checks that recipe is valid ie, enabled
// function isValidRecipe(array $recipe) : bool
// {
//     if (array_key_exists('is_enabled', $recipe)) {
//         $isEnabled = $recipe['is_enabled'];
//     } else {
//         $isEnabled = false;
//     }
//     return $isEnabled;
// }

// // gets all recipes which are valid
// function getRecipes(array $recipes) : array
// {
//     $validRecipes = [];

//     foreach($recipes as $recipe) {
//         if (isValidRecipe($recipe)) {
//             $validRecipes[] = $recipe;
//         }
//     }
//     return $validRecipes;
// }