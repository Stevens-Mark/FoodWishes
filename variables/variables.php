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
  
  // $SMTPUsername = 'youmail@gmail.com';    // SMTP username 
  // $SMTPPassword = 'generatedByGmail';     // SMTP password : you need to generate an "app password" from google (see their documentation) 
  // $recipientEmail = 'yourmail@gmail.com'

  ?>