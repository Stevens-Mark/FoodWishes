<?php
// load all data to be used 
include_once($_SERVER['DOCUMENT_ROOT'] . "/config/mysql.php");
include_once($_SERVER['DOCUMENT_ROOT'] .  '/config/user.php');
include_once($_SERVER['DOCUMENT_ROOT'] . "/variables/variables.php");

//  If the cookie or session is present
if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
    ];
} else {
    // throw new Exception('You must be authenticated !');
    header('Location: '.$rootUrl.'index.php');
}

// meaning of ?? Null Coalescing Operator
// assigns $_COOKIE['LOGGED_USER'] variable  to $loggedUser if the $_COOKIE['LOGGED_USER'] variable exists or has a value that is not NULL, otherwise  $_SESSION['LOGGED_USER']' is assigned instead