<?php

$postData = $_POST;
 // Validation, or not, of login info entered by user...
if (isset($postData['email']) &&  isset($postData['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $postData['email'] &&
            $user['password'] === $postData['password']
        ) {
            $loggedUser = [
                'email' => $user['email'],
            ];

            /**
             * Cookie :
             * If user/password match save to cookie the email for future validation
             */
            // setcookie(
            //     'LOGGED_USER',
            //     $loggedUser['email'],
            //     [
            //         'expires' => time() + 365*24*3600,  // expires in 1 year
            //         'secure' => true,
            //         'httponly' => true,
            //     ]
            // );

            // if user found, save the user's email in session
            $_SESSION['LOGGED_USER'] = $loggedUser['email'];
        } else {
          // otherwise display error message
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $postData['email'],
                $postData['password']
            );
        }
    }
}

// If the cookie is already present then set login credentials to cookie value
// if (isset($_COOKIE['LOGGED_USER'])) {
//     $loggedUser = [
//         'email' => $_COOKIE['LOGGED_USER'],
//     ];
// }

if (isset($_SESSION['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_SESSION['LOGGED_USER'],
    ];
}
?>

<!-- If user not identified display the login form -->
<?php if(!isset($loggedUser)): ?>
    <form action="index.php" method="post">
        <!-- If error message (see above) then show it -->
        <?php if(isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo($errorMessage); ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" autocomplete="username" aria-describedby="email-help" placeholder="you@example.com">
            <div id="email-help" class="form-text">The email used to create the account.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
      <!--  otherwise, If user connected then show success message (which appears above recipes on home/index page) -->
  <?php else: ?>
      <div class="alert alert-success" role="alert">
          Hello <?php echo($loggedUser['email']); ?> !
      </div>
<?php endif; ?>