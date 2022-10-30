<?php
  include_once('connect.php');
?>

<!-- If user not identified display the login form -->
<?php if(!isset($_SESSION['LOGGED_USER'])): ?> 
    <form action="index.php" method="post">
        <!-- If error message then show it -->
        <?php if(isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com" autocomplete="current-email">
            <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <!--  otherwise, If user connected then how success message (which appears above recipes on home/index page) -->
  <?php else: ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $_SESSION['LOGGED_USER']; ?> et bienvenue sur le site !
    </div>
<?php endif; ?>