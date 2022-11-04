<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update The Recipe - Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

      <!-- include header -->
      <?php include_once('include/header.php'); ?>

      <!-- Contact Us form -->
        <h1>Contact Us</h1>
          <form action="submit_contact.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@example.com">
                  <div id="email-help" class="form-text">We will not resell your email.</div>
              </div>
              <div class="mb-3">
                  <label for="message" class="form-label">Votre message</label>
                  <textarea class="form-control" placeholder="Express yourself" id="message" name="message"></textarea>
              </div>
              <!-- File upload ! -->
              <div class="mb-3">
                  <label for="image" class="form-label">Your File</label>
                  <input type="file" class="form-control" id="image" name="image" aria-describedby="image-help" />
                  <div id="image-help" class="form-text">Upload either JPG, PNG or GIF (maximum size 2MB).</div>
              </div>
              <button type="submit" class="btn btn-primary">Send</button>
          </form>
          <br />
    </div>

    <!-- include footer -->
    <?php include_once('include/footer.php'); ?>

</body>
</html>
<!-- action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" -->