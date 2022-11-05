<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");
include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');

$extensionError = $sizeError = $fileUploaded = false;
$sentMessage = ' ';
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];

// Let's test if the file has been added and if there is no errors
if( isset($_FILES['image']) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0)  {

  // test size
  if($_FILES["image"]["size"] > 2097152 ){ // 2 MB 
    $sizeError = true;
 }
  // Let's test if the extension is allowed
  $fileInfo = pathinfo($_FILES['image']['name']);
  $extension = $fileInfo['extension'] ?? null;
  $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
  if(!in_array(strtolower($extension), $allowedExtensions)) {
    $extensionError = true;
  }
 
  // no errors? We can validate the file and store it temporarily with a unique name
  if(!($extensionError) && !($sizeError)) {
    $uploadedFile = str_replace(' ', '_', $_FILES['image']['name']);
    $pieces = explode(".", $uploadedFile);
    $newFilename = $pieces[0] .'.'.uniqid() . '.' . $pieces[1];
    move_uploaded_file(
      $_FILES['image']['tmp_name'],
      'uploads/' . $newFilename);
  }
}

  // Import PHPMailer classes into the global namespace 
  use PHPMailer\PHPMailer\PHPMailer; 
  use PHPMailer\PHPMailer\SMTP; 
  use PHPMailer\PHPMailer\Exception; 
  
  // Include library files 
  require 'PHPMailer/Exception.php'; 
  require 'PHPMailer/PHPMailer.php'; 
  require 'PHPMailer/SMTP.php'; 
  
  // Create an instance; Pass `true` to enable exceptions 
  $mail = new PHPMailer; 
  
  // Server settings 
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;   // Enable verbose debug output 
  $mail->isSMTP();                            // Set mailer to use SMTP 
  $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers 
  $mail->SMTPAuth = true;                     // Enable SMTP authentication 
  $mail->Username = $SMTPUsername;            // SMTP username 
  $mail->Password = $SMTPPassword;            // SMTP password 
  $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
  $mail->Port = 465;                          // TCP port to connect to 
  
  // Sender info 
  $mail->setFrom($email, 'PHPServer'); 
  $mail->addReplyTo($email, 'PHPSender'); 
  
  // Add a recipient 
  $mail->addAddress($recipientEmail); 
  
  //$mail->addCC('cc@example.com'); 
  //$mail->addBCC('bcc@example.com'); 
  
  // Set email format to HTML 
  $mail->isHTML(true); 
  
  // Mail subject 
  $mail->Subject = 'Email from Localhost PHP Project'; 
  
  // Mail body content 
  $bodyContent = $message; 
  $bodyContent .= '<p>This HTML email sent from the localhost server using PHP</p>'; 
  $mail->Body = $bodyContent; 

  // logic to determine whether to send/refuse the email with or without attachment
  if (!empty($email) && !empty($message) && !empty($newFilename) ) {
    $mail->AddAttachment("uploads/".$newFilename);
    $fileUploaded = true;
    // Send email with 'good' attachment
      if(!$mail->send()) { 
          $sentMessage = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
      } else { 
        $sentMessage = 'Message has been sent with attachment.'; 
      }
      // if attachment error, refuse to send email - 'bad' attachment
  } elseif ((!empty($email) && !empty($message)) && ($extensionError || $sizeError) ) {
      $sentMessage = 'Message has NOT been sent due to attachment error.'; 
    } elseif (!empty($email) && !empty($message) ) {
  // Send email - no attachment
  if(!$mail->send()) { 
      $sentMessage = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
  } else { 
    $sentMessage = 'Message has been sent (no attachment provided).'; 
  }
}

  // remove temporary uploaded file if uploaded
  if ($fileUploaded) {
    unlink("uploads/".$newFilename);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Received</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
      <?php include_once('include/header.php'); ?>

      <!-- If info entered by user not valid, show message -->
      <?php if ( (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) || (!isset($message) || empty($message)) ): ?>
        <section>
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
              <p class="card-text"><b>Email</b> : <?php echo strip_tags($email); ?></p>
              <p class="card-text"><b>Message</b> : <?php echo strip_tags($message); ?></p>
              <?php if(($extensionError)) : ?>
                <p class="card-text text-danger"><b>File Type</b> : <?php echo("This extension is not allowed, please choose a JPEG, PNG or GIF file.") ?></p>
              <?php endif; ?>
              <?php if(($sizeError)) : ?>
                <p class="card-text text-danger"><b>File Size</b> : <?php echo($_FILES["image"]["size"]) ?> bytes, but maximum size is 2 MB. </p>
              <?php endif; ?>
              <p class="card-text "><b>Status</b> : <?php echo($sentMessage) ?></p>
            </div>
          </div>
        </section>
      <?php endif; ?> 
              
    </div>
    <?php include_once('include/footer.php'); ?>
</body>
</html>


