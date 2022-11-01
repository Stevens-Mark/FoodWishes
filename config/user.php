<?php

//  If the cookie or session is present
if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
    ];
} else {
    echo 'Either, You are not logged in or you are not a valid user !';
    throw new Exception('You must be authenticated !');
}
