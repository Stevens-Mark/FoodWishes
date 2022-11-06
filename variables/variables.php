<?php

  // Retrieving variables using the MySQL client
  $usersStatement = $mysqlClient->prepare('SELECT * FROM users');
  $usersStatement->execute();
  $users = $usersStatement->fetchAll();

  $recipesStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE is_enabled is TRUE');
  $recipesStatement->execute();
  $recipes = $recipesStatement->fetchAll();

  if(isset($_GET['limit']) && is_numeric($_GET['limit'])) {
      $limit = (int) $_GET['limit'];
  } else {
      $limit = 100;
  }

  // used for linking files & links to pages
  $rootPath = $_SERVER['DOCUMENT_ROOT'];
  $rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
  

  
  // EXAMPLE 1
  
  // $sqlQuery = 'SELECT * FROM recipes WHERE is_enabled = TRUE';
  // $recipesStatement = $db->prepare($sqlQuery);
  // $recipesStatement->execute();
  // $recipes = $recipesStatement->fetchAll(); 

  // EXAMPLE 2
  // $sqlQuery ="SELECT * FROM `recipes` WHERE author = ?";
  // $recipesStatement = $db->prepare($sqlQuery);
  // $recipesStatement->execute([$_SESSION['LOGGED_USER']]);
  // $recipes = $recipesStatement->fetchAll(); 

  // EXAMPLE 3
  // $sqlQuery ="SELECT * FROM `recipes` WHERE author = :author AND is_enabled = :is_enabled";
  // $recipesStatement = $db->prepare($sqlQuery);
  // $recipesStatement->execute([
  //   'author' => $_SESSION['LOGGED_USER'],
  //   'is_enabled' => true,
  // ]);
  // $recipes = $recipesStatement->fetchAll(); 

  ?>