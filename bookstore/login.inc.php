<?php
session_start();
include 'dbh.php';

if (isset($_POST['submit'])) {
    $usr = $_POST['usr'];
    $password = $_POST['pwd'];

    try {
        $sql = "SELECT * FROM user WHERE name = ? OR name = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usr, $usr]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid login credentials');</script>";
            header("Location: signup_log.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>