<?php


$host = "localhost";
$dbName = "forums";
$user = "root";
$password = "";



try {
    $dsn = "mysql:host=" . $host . ";dbname=" . $dbName . ";charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

   
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}
