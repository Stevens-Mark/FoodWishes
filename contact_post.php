<?php
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');

  // define variables & those received from page redirect
  $fileUploaded = false;
  $newFilename = $_SESSION['newFilename'];
  $_POST = $_SESSION['contactData'];
  $full_name = $_POST['full_name'];
  $subject = $_POST['subject'];
  $email = $_POST['email'];
  $message = $_POST['message'];

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
  $mail->setFrom($email, 'PHPServer: Sender : ' . $full_name); 
  $mail->addReplyTo($email, $full_name); 
  
  // Add a recipient 
  $mail->addAddress($recipientEmail); 
  
  //$mail->addCC('cc@example.com'); 
  //$mail->addBCC('bcc@example.com'); 
  
  // Set email format to HTML 
  $mail->isHTML(true); 
  
  // Mail subject 
  $mail->Subject = $subject; 
  
  // Mail body content 
  $bodyContent = $message; 
  $bodyContent .= '<p>This HTML email sent from the localhost server using PHP</p>'; 
  $mail->Body = $bodyContent; 

  // determine whether to send the email with or without attachment
  if (!empty($email) && !empty($message) && !empty($newFilename) ) {
    $mail->AddAttachment("uploads/".$newFilename);
    $fileUploaded = true;
  }

  // Send email 
  if(!$mail->send()) { 
      $sentMessage = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
  } else { 
    $sentMessage = 'Message has been sent... (attachments over 2MB will be automatically removed).'; 
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
    <meta name="author" content="Mark Stevens">
    <meta name="description" content="Built using PHP & MySQL. This is a recipe website where users can sign up & share their recipes with other users as well as comment on the recipes displayed. This page displays a success message when new user's message has been sent'" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    
</head>
<body class="backTwo d-flex flex-column min-vh-100">
    <main class="container">
      <?php include_once($rootPath.'/include/header.php'); ?>
        <section>
          <div class="d-flex align-items-center mb-4">
            <img class="icon-h1" src="<?php echo($rootUrl). '/assets/plateLogo.png'; ?>" alt="" >
            <h1>essage Received !</h1>
          </div>
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Reminder of your information</h2>
                <p class="card-text"><b>Email</b> : <?php echo strip_tags($email); ?></p>
                <p class="card-text"><b>Message</b> : <?php echo strip_tags($message); ?></p>
                <p class="card-text "><b>Status</b> : <?php echo($sentMessage) ?></p>
              </div>
          </div>
        </section>            
    </main>
    <?php include_once($rootPath.'/include/footer.php'); ?>
</body>
</html>


