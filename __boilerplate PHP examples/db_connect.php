<?php

    $host = "127.0.0.1";  // if localhost
    $db = "";             // database name
    $user = "";           // sql user name
    $pass = "";           // sql user password

    $charset = "utf8mb4"; // default charset

    // data source name, tells PDO where db is and how to connect
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]; // default options

    try { // try to make PDO
        $pdo = new PDO($dsn, $user, $pass, $options); // make the pdo
    }
    catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode()); // show error
    }

?>