<?php session_start(); 

  // load all data to be used 
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/config/user.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $getData = $_GET;
  $email = $getData['id'];

  // if there is no id in the parameter, display an error message 
  if (!isset($email) || (empty($email)) )
  {
    $errorMessage = 'Something seems to have gone wrong. Please try again.';
    echo $errorMessage;
    return;
  }	else {
    // otherwise retrieve the user to be deleted
    $retrieveUser = $mysqlClient->prepare('SELECT * FROM `users` WHERE email= :email');
    $retrieveUser->execute([
      'email' => $email,
    ]);
    $user = $retrieveUser->fetch(PDO::FETCH_ASSOC);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete A user</title>
    <meta name="author" content="Mark Stevens">
    <meta name="description" content="Built using PHP & MySQL. This is a recipe website where users can sign up & share their recipes with other users as well as comment on the recipes displayed. This page allows the user to close their account." >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
</head>
<body class="backTwo d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once($rootPath.'/include/header.php'); ?>
      <section>
        <div class="d-flex align-items-center mb-4">
          <img class="icon-h1" src="<?php echo($rootUrl). '/assets/plateLogo.png'; ?>" alt="" >
          <h1>Delete Your Account !</h1>
        </div>
        <div class="card">
          <div class="card-body">
              <p class="card-text"><b>Account Holder : </b><i class="text-muted"><?php echo ucfirst(displayName($email, $users)); ?></i></p>
          </div>      
        </div>

        <form action="destroy_post.php" method="POST">
          <div class="mb-3 visually-hidden">
            <label for="id" class="form-label">User ID</label>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($user['user_id']); ?>">
          </div>
            <p class="text-danger mt-2"><?php echo($email != $loggedUser['email'] ? 'Sorry, you do not have the permissions to delete this account !' : 'This will be PERMANENT. Are you sure ?' ); ?></p>
            <!-- disable delete button if user is not owner of the user account -->
            <button type="submit" class="btn btn-danger mt-2" <?php echo($email != $loggedUser['email'] ? 'disabled' : '' ); ?> >Delete</button>
            <a class="btn btn-info mt-2 mx-2" href="<?php echo($rootUrl)?>index.php">Cancel</a>
        </form>
        <br />
      </section>
</main>
    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>