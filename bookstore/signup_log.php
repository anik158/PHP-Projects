<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" typle="text/css" href="assets/css/log_style.css">
</head>

<body>


    <div class="container">

        <div class="container-sign">
            <a href="index.php"><h2>Home</h2></a>
            <h1>Sign up</h1>
            <p>Don't have an account yet? Sign Up Here</p>
            <form action="signup.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="usr" placeholder="Username"><br>
                <input type="password" name="pwd" placeholder="password"><br>
                <input type="password" name="pwdrepeat" placeholder="Repeat Password"><br>
                <input type="email" name="email" placeholder="E-mail"><br>
                <input type="submit" value="Sign Up" class="submit" name="submit">
            </form>
        </div>

        <div class="container-log">
            <h1>Log in</h1>
            <p>Already have an account? Login Here</p>
            <form action="login.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="usr" placeholder="Username"><br>
                <input type="password" name="pwd" placeholder="password"><br>
                <input type="submit" value="Log In" class="submit" name="submit">
            </form>
        </div>
    </div>

</body>

</html>