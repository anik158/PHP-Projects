
<?php
session_start();
include_once "../includes/auto_loader.inc.php";
$pdo = new Dbh();
$conn = $pdo->connect();
if (isset($_POST['update'])) {
    $username = $_POST['usr'];
    $email = $_POST['email'];
    $currentPassword = $_POST['pwd'];
    $newPassword = $_POST['newpwd'];
    $adminId = 1;

    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $sql = "UPDATE admin SET username = ?, email = ?, password = ? WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$username, $email, $hashedNewPassword, $adminId])) {
        header("location: update_ad.php?message=UpdateSuccessfull");
    } else {
        header("location: update_ad.php?message=UpdateFailed");
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ad_style.css">
    <link rel="icon" href="img/favIcon.png" type="image/png">
    <title>Log In</title>
    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
        }
    </style>

<script>
        function confirmUpdate() {
            var confirmed = confirm("Are you sure you want to update?");
            return confirmed;
        }

        function validateForm() {
            var username = document.getElementById("usr").value;
            var email = document.getElementById("email").value;
            var currentPassword = document.getElementById("pwd").value;
            var newPassword = document.getElementById("newpwd").value;
            var confirmPassword = document.getElementById("repwd").value;

            if (username.trim() === "" || email.trim() === "" || currentPassword.trim() === "" || newPassword.trim() === "" || confirmPassword.trim() === "") {
                alert("All fields are required.");
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert("New Password and Re-Type Password must match.");
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (newPassword.length < 8) { // Corrected variable name here
                alert("Password must be at least 8 characters long.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<nav>
        <p class="title">Admin Panel</p>
    </nav>
    <main>
        <h2 style="margin-left: 400px;color: coral;width: 100%;">Update Admin</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data"  onsubmit="return validateForm() && confirmUpdate()">
            <label for="usr">Username</label>
            <input type="text" id="usr" name="usr">
            <label for="usr">Email</label>
            <input type="text" id="email" name="email">
            <label for="pwd">Current Password</label>
            <input type="password" id="pwd" name="pwd">
            <label for="pwd">New Password</label>
            <input type="password" id="newpwd" name="newpwd">
            <label for="pwd">Re-Type Password</label>
            <input type="password" id="repwd" name="repwd">
            <br>
            <div class="button-container">
                <input type="submit" value="Update" name="update">
                <a name="return" class="return" href="admin_panel.php">Return</a>
            </div>
        </form>
    </main>
</body>
</html>
