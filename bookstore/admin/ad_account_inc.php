<?php

session_start();

include('../dbh.php');
$pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash ($_POST ['password'], PASSWORD_DEFAULT);


    if (!empty($name) && !empty($email) && !empty($password)) {
       
        $sql = "UPDATE admin SET name = :name, email = :email, password = :password WHERE id = :admin_id";

        //$admin_id = 1;

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':admin_id', $_SESSION['admin_id']);

        $stmt->execute();

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        header('Location: ad_index.php');

        exit();
    } else {
        echo "<p>Please enter all the fields.</p>";
    }
}
?>