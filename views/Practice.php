<?php

  // 2 exemples
  $romanSalad = [
    'title' => 'Salade Romaine',
    'recipe' => 'Etape 1 : Lavez la salade ; Etape 2 : euh ...',
    'author' => 'laurene.castor@exemple.com',
    'is_enabled' => true,
  ];

  $sushis = [
    'title' => 'Sushis',
    'recipe' => 'Etape 1 : du saumon ; Etape 2 : du riz',
    'author' => 'laurene.castor@exemple.com',
    'is_enabled' => false,
  ];

  function isValidRecipe(array $recipe) : bool
  {
      if (array_key_exists('is_enabled', $recipe)) {
          $isEnabled = $recipe['is_enabled'];
      } else {
          $isEnabled = false;
      }

      return $isEnabled;
  }

  // Répond true !
  $isRomandSaladValid = isValidRecipe($romanSalad);

  // Répond false !
  $isSushisValid = isValidRecipe($sushis);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Notre première instruction : echo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
        <h1>Ma page web</h1>
        <p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p>

<?php
  // $mickael = ['Mickaël Andrieu', 'mickael.andrieu@exemple.com', 'S3cr3t', 34];
  // $mathieu = ['Mathieu Nebra', 'mathieu.nebra@exemple.com', 'devine', 33];
  // $laurene = ['Laurène Castor', 'laurene.castor@exemple.com', 'P4ssw0rD', 28];
  // $John = ['John Castor', 'laurene.castor@exemple.com', 'P4ssw0rD', 28];

  // $users = [$mickael, $mathieu, $laurene, $John];

  // $lines = 4; // nombre d'utilisateurs dans le tableau
  // $counter = 0;

  // while ($counter < $lines) {
  //     echo $users[$counter][0] . ' ' . $users[$counter][1] . '<br />';
  //     $counter++; // Ne surtout pas oublier la condition de sortie !
  // }


$users = [
    'Mathieu Nebra',
    'Mickaël Andrieu',
    'Laurène Castor',
];

$positionMathieu = array_search('Mathieu Nebra', $users);
echo '"Mathieu" se trouve en position ' . $positionMathieu . PHP_EOL;

$positionLaurène = array_search('Laurène Castor', $users);
echo '"Laurène" se trouve en position ' . $positionLaurène . PHP_EOL;


// Enregistrons les informations de date dans des variables

// $day = date('d');
// $month = date('m');
// $year = date('Y');

// $hour = date('H');
// $minut = date('i');

// // Maintenant on peut afficher ce qu'on a recueilli
// echo 'Bonjour ! Nous sommes le ' . $day . '/' . $month . '/' . $year . ' et il est ' . $hour. ' h ' . $minut;


// $recipe = [
//     'title' => 'Salade Romaine',
//     'recipe' => 'Etape 1 : Lavez la salade ; Etape 2 : euh ...',
//     'author' => 'laurene.castor@exemple.com',
// ];

// echo sprintf(
//     '%s par "%s" : %s',
//     $recipe['title'],
//     $recipe['author'],
//     $recipe['recipe']
// );
?>

    <?php if ($isRomandSaladValid): ?>
      <div><?php echo 'valid : ' .$isRomandSaladValid. ' ' ?></div>
    <?php endif; ?>

    <?php if (!$isSushisValid): ?>
      <div><?php echo 'not valid : ' .$isSushisValid. ' '  ?></div>
    <?php endif; ?>

  </body>
</html>
