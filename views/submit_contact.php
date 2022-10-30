<?php

  if (
      (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
      || (!isset($_POST['message']) || empty($_POST['message']))
      )
  {
    echo('Il faut un email et un message valides pour soumettre le formulaire.');
      return;
  }
  // for security to stop scripts running - cross-site scripting

  // leaves tags in but safe
  // eg It will transform the angle brackets of the HTML tags < and > into &lt; and &gt
  $email = htmlspecialchars($_POST['email']); 
  $message = htmlspecialchars($_POST['message']); 

  // or strips out the tags completely
  // $email = strip_tags($_POST['email']); 
  // $message = strip_tags($_POST['message']);

  function validateUpload() {
  // Let's test if the file has been sent and if there is no error
  if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0)
  {
    // Let's test if the file is not too big
    if ($_FILES['screenshot']['size'] <= 1000000)
    {
      // Let's test if the extension is allowed
      $fileInfo = pathinfo($_FILES['screenshot']['name']);
      $extension = $fileInfo['extension'];
      $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
      if (in_array($extension, $allowedExtensions))
      {
        // We can validate the file and store it permanently with unique name
        $uploadedFile = str_replace(' ', '_', $_FILES['screenshot']['name']);
        $pieces = explode(".", $uploadedFile);
        $newFilename = $pieces[0] .'.'.uniqid() . '.' . $pieces[1];
        move_uploaded_file(
          $_FILES['screenshot']['tmp_name'],
          '../uploads/' . $newFilename);
    
        echo "L'envoi a bien été effectué !";
        return;
      }
    }
  }
  echo "There was a problem !"; 
}
?>

<!-- contact.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Formulaire de Contact</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

      <!-- inclusion de l'entête du site -->
      <?php include_once('include/header.php'); ?>

      <h1>Message bien reçu !</h1>

      <?php if ( (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        || (!isset($_POST['message']) || empty($_POST['message'])) ): ?>

        <div class="card">
          <div class="card-body">
              <h5 class="card-title">Rappel de vos informations</h5>
              <p class="card-text">Il faut un email et un message valides pour soumettre le formulaire.</p>
            </div>
        </div>

      <? else: ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?php echo ($email); ?></p>
                <p class="card-text"><b>Message</b> : <?php echo ($message); ?></p>
            </div>
        </div>
        <p class="card-text"><?php validateUpload() ?></p>
      <?php endif; ?>
    </div>

      <!-- inclusion du bas de page du site -->
      <?php include_once('include/footer.php'); ?>
</body>
</html>
