<?php
    // try to connect to database & if not throw error
    // try
    // {
    //   $mysqlClient = new PDO(  // Often this object is identified by the variable $conn or $db
    //     'mysql:host=localhost;
    //     dbname=we_love_food;
    //     charset=utf8',
    //     'root',
    //     'root',
    //     [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    //   );
    // }
    // catch (Exception $e)
    // {
    //     die('Error: ' . $e->getMessage());
    // }

    const MYSQL_HOST = 'localhost';
    const MYSQL_PORT = 3306;
    const MYSQL_NAME = 'we_love_food';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = 'root';
    
    try {
        $mysqlClient = new PDO(
            sprintf('mysql:host=%s;dbname=%s;port=%s', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
            MYSQL_USER,
            MYSQL_PASSWORD
        );
        $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $exception) {
        die('Erreur : '.$e->getMessage());
    }

