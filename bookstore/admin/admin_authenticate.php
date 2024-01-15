<?php
session_start();

include '../dbh.php';

$pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {

        $sql = "SELECT * FROM admin WHERE email = :email or name = :email";

       

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':email', $email);


        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($result) {

            if (password_verify($password, $result['password'])) {
                $_SESSION['name'] = $result['name'];
                $_SESSION['admin_id'] = $result['admin_id'];
                $_SESSION['email'] = $result['email'];

                header('Location: ad_index.php');

                exit();
            } else {
                echo "<p>The password you entered is not valid.</p>";
            }
        } else {
            echo "<p>The email you entered is not registered.</p>";
        }
    } else {

        echo "<p>Please enter both email and password.</p>";
    }
}
?>