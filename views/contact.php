<!-- contact.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Formulaire de Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

      <!-- include header -->
      <?php include_once('include/header.php'); ?>

      <!-- Contact form -->
        <h1>Contactez nous</h1>
          <form action="submit_contact.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help">
                  <div id="email-help" class="form-text">Nous ne revendrons pas votre email.</div>
              </div>
              <div class="mb-3">
                  <label for="message" class="form-label">Votre message</label>
                  <textarea class="form-control" placeholder="Exprimez vous" id="message" name="message"></textarea>
              </div>
              <!-- File upload ! -->
              <div class="mb-3">
                  <label for="screenshot" class="form-label">Votre capture d'écran</label>
                  <input type="file" class="form-control" id="screenshot" name="screenshot" />
              </div>
              <button type="submit" class="btn btn-primary">Envoyer</button>
          </form>
          <br />
    </div>

    <!-- include footer -->
    <?php include_once('include/footer.php'); ?>

  <!-- bootstrap script needed here so navbar toggle functionality will work -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
