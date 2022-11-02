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
    return 'utilisateur inconnu';
}

// display username
function displayName(string $authorEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'];
        }
    }
    return 'utilisateur inconnu';
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

// function to check uploaded file
function validateUpload() {
  // Let's test if the file has been sent and if there is no error
  if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0)
  {
    // Let's test if the file is not too big
    if ($_FILES['screenshot']['size'] <= 1000000)
    {
      // Let's test if the extension is allowed
      $fileInfo = pathinfo($_FILES['screenshot']['name']);
      $extension = $fileInfo['extension'];
      $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
      if (in_array($extension, $allowedExtensions))
      {
        // We can validate the file and store it permanently with unique name
        $uploadedFile = str_replace(' ', '_', $_FILES['screenshot']['name']);
        $pieces = explode(".", $uploadedFile);
        $newFilename = $pieces[0] .'.'.uniqid() . '.' . $pieces[1];
        move_uploaded_file(
          $_FILES['screenshot']['tmp_name'],
          '../uploads/' . $newFilename);
    
        echo "Uploaded as : " .$newFilename ." !";
        return;
      }
    }
  }
  echo "There was a problem so no file uploaded!"; 
}