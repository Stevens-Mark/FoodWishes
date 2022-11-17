<?php 
  session_start(); 
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  // define variables and set to empty/boolean values
  $full_name = $email = $subject = $message = "";
  $full_nameErr = $emailErr = $subjectErr = $messageErr = "";
  $full_nameFail = $emailFail = $subjectFail = $messageFail  = false;
  $extensionError = $sizeError = false;

  // form validation
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // name
    if (empty($_POST["full_name"])) {
      $full_nameErr = "Name is required.";
      $full_nameFail = true;
    } else {
      $full_name = test_input($_POST["full_name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$full_name)  || strlen($full_name) < 2) {
        $full_nameErr = "Minimum length is 2 characters & only letters and white space allowed.";
        $full_nameFail = true;
      }
    }
  
    // email
    if (empty($_POST["email"])) {
      $emailErr = "Email is required.";
      $emailFail = true;
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
        $emailFail = true;
      }
    }

    // subject
    if (empty($_POST["subject"])) {
      $subjectErr = "Subject title is required.";
      $subjectFail = true;
    } else {
      $subject = test_input($_POST["subject"]);
      // check subject length minimum
      if (strlen($subject) < 5) {
        $subjectErr = "Minimum length is 5 characters.";
        $subjectFail = true;
      }
    }

    // message
    if (empty($_POST["message"])) {
      $messageErr = "Message is required.";
      $messageFail = true;
    } else {
      $message = test_input($_POST["message"]);
      // check message length minimum
      if (strlen($message) < 5) {
        $messageErr = "Minimum message length is 5 characters.";
        $messageFail = true;
      }
    }

    // Let's test if a file has been added and if so, that there are no errors
    if ( isset($_FILES['image']) && !empty($_FILES['image'])  && $_FILES['image']['error'] == 0 ) {

      // test size
      if($_FILES["image"]["size"] > 2097152 ) { // 2 MB 
        $sizeError = true;
      }

      // test if extension is allowed
      $fileInfo = pathinfo($_FILES['image']['name']);
      $extension = $fileInfo['extension'] ?? null;
      $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
      if(!in_array(strtolower($extension), $allowedExtensions)) {
        $extensionError = true;
      }
 
      // no errors? validate the file and store it temporarily with a unique name
      if(!($extensionError) && !($sizeError)) {
        $uploadedFile = str_replace(' ', '_', $_FILES['image']['name']);
        $pieces = explode(".", $uploadedFile);
        $newFilename = $pieces[0] .'.'.uniqid() . '.' . $pieces[1];
        move_uploaded_file(
          $_FILES['image']['tmp_name'],
          'uploads/' . $newFilename);
      }
    }

    // if contact info ok, send the email
    if ( !$full_nameFail && !$emailFail && !$subjectFail && !$messageFail && !$extensionError && !$sizeError )
    {    
      // Assign the _POST data to the _SESSION so can pass data to redirected page
      $_SESSION['contactData']  = $_POST;
      $_SESSION['newFilename'] = $newFilename;
      session_write_close();

      header('Location: '.$rootUrl.'contact_post.php');
      exit();
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo($rootUrl.'/css/style.css'); ?>">
  </head>
<body class="backOne d-flex flex-column min-vh-100">
    <main class="container">

      <!-- include header -->
      <?php include_once($rootPath.'/include/header.php'); ?>

     <section>
        <div class="d-flex align-items-center mb-4">
          <img class="icon-h1" src="<?php echo($rootUrl). '/assets/plateLogo.png'; ?>" alt="" >
          <h1>Contact Us</h1>
        </div>
         <!-- Contact Us form -->
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="full_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="John Doe" value="<?php echo $full_name;?>">
                <span class="text-danger"><?php echo $full_nameErr;?></span>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@example.com" value="<?php echo $email;?>">
                  <div id="email-help" class="form-text">We will not resell your email.</div>
                  <span class="text-danger"><?php echo $emailErr;?></span>
              </div>
              <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="....." value="<?php echo $subject;?>">
                <span class="text-danger"><?php echo $subjectErr;?></span>
              </div>
              <div class="mb-3">
                  <label for="message" class="form-label">Your message</label>
                  <textarea rows="5" class="form-control" placeholder="Express yourself" id="message" name="message"><?php echo $message;?></textarea>
                  <span class="text-danger"><?php echo $messageErr;?></span>
              </div>
              <!-- File upload ! -->
              <div class="mb-3">
                  <label for="image" class="form-label">Your File <i>(optional)</i></label>
                  <input type="file" class="form-control" id="image" name="image" aria-describedby="image-help">
                  <div id="image-help" class="form-text mb-3">Upload either JPG, PNG or GIF (maximum size 2MB).</div>
                 <!-- display file upload errors if needed  -->
                <?php if(($extensionError)) : ?>
                  <p class="card-text text-danger" ><b>File Type</b> : <?php echo(" extension not allowed, please choose a JPEG, PNG or GIF file.") ?></p>
                <?php endif; ?>
                <?php if(($sizeError)) : ?>
                  <p class="card-text text-danger"><b>File Size</b> : <?php echo($_FILES["image"]["size"]) ?> bytes, but maximum size is 2 MB. </p>
                <?php endif; ?>
              </div>
              <button type="submit" class="btn btn-primary">Send</button>
          </form>
          <br />
      </section>
    </main>

    <!-- include footer -->
    <?php include_once($rootPath.'/include/footer.php'); ?>

</body>
</html>
