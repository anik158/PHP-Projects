<?php
$host = 'localhost';
$dbName = 'bookstore';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=" . $host . ";dbname=" . $dbName;

    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
} catch (PDOException $e) {
    echo "error is: " . $e;
}
?>