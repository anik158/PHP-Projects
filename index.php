<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" typle="text/css" href="style.css">
</head>
<body>

    <header>

        <div class="header-brand">
            <p>aTravels</p>
        </div>

        <nav>
            <div class="hb1">
                <a href="index.php">Home</a>
            </div>

            <div class="hb1">
                <a href="#">Portfolio</a>
            </div>

            <div class="hb1">
                <a href="#">Contact</a>
            </div>

            <div class="hb1">
                <a href="#">About me</a>
            </div>

            <div class="hb2">
                <ul>
                    <?php 
                        if(isset($_SESSION["useruid"])){
                    ?>
                    <li><a href="#"><?php echo $_SESSION["useruid"];?></a></li>
                    <li><a href="includes/logout.inc.php">LOG OUT</a></li>
                    <?php 
                    }else{
                    ?>
                    <li><a href="#">SIGN UP</a></li>
                    <li><a href="#">LOG IN</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">

            <div class="container-sign">
                <h1>Sign up</h1>
                <p>Don't have an account yet? Sign Up Here</p>
                    <form  action="includes/signup.inc.php" method="post">
                        <input type="text" name="uid" placeholder="Username"><br>
                        <input type="password" name="pwd" placeholder="password"><br>
                        <input type="password" name="pwdrepeat" placeholder="Repeat Password"><br>
                        <input type="email" name="email" placeholder="E-mail"><br>
                        <input type="submit" value="Sign Up" class="submit" name="submit">
                    </form>
            </div>

            <div class="container-log">
                <h1>Log in</h1>
                <p>Already have an account? Login Here</p>
                    <form action="includes/login.inc.php" method="post">
                        <input type="text" name="uid" placeholder="Username"><br>
                        <input type="password"  name="pwd" placeholder="password"><br>
                        <input type="submit" value="Log In" class="submit" name="submit">
                    </form>
            </div>
    </div>
 
</body>
</html>