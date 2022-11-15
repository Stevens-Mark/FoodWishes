<?php  
  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");

  $error = $_SERVER["REDIRECT_STATUS"];
  $error_title ='';
  $error_message = '';
  if ($error == 404) {
    $error_title = '404 Page Not found';
    $error_message = 'Please return to main page';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="backTwo d-flex flex-column min-vh-100" style="background: #CBD18F;">
  <main class="container">
    <?php include_once($rootPath.'/include/header.php'); ?>
    <div class="d-flex justify-content-center align-items-center" style="height:calc( 100vh - 144px );">
      <div class="text-center">
        <h1><?php echo($error_title) ?></h1>
        <h2><a class="nav-link" href="<?php echo($rootUrl). 'index.php'; ?>"><?php echo($error_message) ?></a></h2>
      </div>
    </div>   
  </main>
  <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>
