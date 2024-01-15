<?php
include 'dbh.php'; 
if (isset($_POST['submit'])) {
    $username = $_POST['usr'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];

    if (empty($username) || empty($password) || empty($email) || $password !== $passwordRepeat) {
        echo "<script>alert('Fill the form properly');</script>";
    } else {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $sql = "INSERT INTO user (id, name, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([uniqid(), $username, $email, $hashedPassword]);
            echo "<script>alert('Registration Successful');</script>";
            header("Location: signup_log.php?msg=registrationSuccessful");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
