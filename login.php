<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/mysql.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/variables/variables.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php");

  $emailErr = $passwordErr =  "";
  $postData = $_POST;

  // User Validation? set cookie/session or display error message...
  if (isset($postData['email']) &&  isset($postData['password'])) {
      foreach ($users as $user) {
        if (
            $user['email'] === $postData['email'] &&
            $user['password'] === $postData['password']
        ) {
            $loggedUser = ['email' => $user['email'], ];

          //  Cookie : If user/password match save to cookie the email for future validation
            setcookie(
              'LOGGED_USER',
              $loggedUser['email'],
              [
                'expires' => time() + 1*24*3600,  // expires in 1 day
                'secure' => true,
                'httponly' => true,
              ]
            );
            // // if user found, save the user's email in session
            $_SESSION['LOGGED_USER'] = $loggedUser['email'];
        } else {
            // otherwise display error message
            $errorMessage = sprintf(
              'The information you entered does not allow you to be identified : (%s/%s)',
              $postData['email'],
              $postData['password']
            );
        }
    }
  }

  // If the cookie is already present then set login credentials to cookie value
  //  otherwise use session value
  if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
    ];
  }

  // show relevant error message next to input where user forgot information
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($postData["email"])) {
      $emailErr = "You forgot to enter your email.";
    } 
    if (empty($postData["password"])) {
      $passwordErr = "You forgot to enter your password.";
    } 
  }
?>

<!-- If user not identified display the login form -->
<?php if(!isset($loggedUser)): ?>
    <form action="index.php" method="post">
        <!-- If error message (see above) then show it -->
        <?php if(isset($errorMessage)) : ?>
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <?php echo($errorMessage); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="mb-4">Log In</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" autocomplete="username" aria-describedby="email-help" placeholder="you@example.com">
            <?php if(empty($emailErr)) : ?>
              <div id="email-help" class="form-text">The email used to create the account.</div>
            <?php else: ?>
              <span class="text-danger"><?php echo $emailErr; ?></span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" aria-describedby="password-help"  placeholder="........" >
            <div id="password-help" class="form-text">The password used to create the account.</div>
            <span class="text-danger"><?php echo $passwordErr; ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
    <!--  otherwise, If user connected then show success message (which appears above recipes on home/index page) -->
  <?php else: ?>
    <div class="alert alert-success mt-2" role="alert">
        Hello <?php echo displayName($loggedUser['email'], $users ); ?> !
    </div>
<?php endif; ?>

