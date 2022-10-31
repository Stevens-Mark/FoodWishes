<?php
session_start();

// $postData = $_POST;

// if (!isset($postData['email']) || !isset($postData['message']))
// {
// 	echo('Il faut un email et un message pour soumettre le formulaire.');
//     return;
// }	

// $email = $postData['email'];
// $message = $postData['message'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Received</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php include_once('include/header.php'); ?>

        <h1>Message Received !</h1>       
        <div class="card">
            <div class="card-body">
              <!-- If info entered by user not valid, show message -->
              <?php if ( (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || (!isset($_POST['message']) || empty($_POST['message'])) ): ?>
                  <p class="card-title">You need an email and a message to submit the form.</p>
              <? else: ?>
                <!-- otherwise display information -->
                  <h2 class="card-title">Reminder of your information</h2>
                  <p class="card-text"><b>Email</b> : <?php echo($_POST['email']); ?></p>
                  <p class="card-text"><b>Message</b> : <?php echo strip_tags($_POST['message']); ?></p>
                  <p class="card-text"><b>File</b> : <?php validateUpload() ?></p>
              <?php endif; ?> 
            </div>
        </div>
      </div>
        <?php include_once('include/footer.php'); ?>
    </div>
</body>
</html>