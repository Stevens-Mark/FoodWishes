<?php
session_start();

$postData = $_POST;
$email = $postData['email'];
$message = $postData['message'];
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
      <!-- If info entered by user not valid, show message -->
      <?php if ( (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) || (!isset($message) || empty($message)) ): ?>
          <h1>Oops !</h1>       
          <div class="card">
              <div class="card-body">
                <p class="card-title">You need an email and a message to submit the form.</p>
            </div>
          </div>
        <? else: ?>
          <!-- otherwise display information -->
            <h1>Message Received !</h1>       
            <div class="card">
              <h2 class="card-title">Reminder of your information</h2>
              <p class="card-text"><b>Email</b> : <?php echo($email); ?></p>
              <p class="card-text"><b>Message</b> : <?php echo strip_tags($message); ?></p>
              <p class="card-text"><b>File</b> : <?php validateUpload() ?></p>
            </div>
          </div>
      <?php endif; ?> 
    </div>
    <?php include_once('include/footer.php'); ?>
</body>
</html>