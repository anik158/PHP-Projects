<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>learner'S Hub</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_product.css">
    <link rel="icon" href="img/favIcon.png" type="image/png">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

</head>
<body>

    <header>
        <a class="header-brand" href="index.php">
            <div class="limg">
                <img src="img/logo.png" width="48px" height="48px" alt="learner'S Hub Icon">
            </div>
            <div class="text">
                <span class="firstPart">learner</span><span class="middlePart">'S</span> <div class="lastPart">HUB</div>
            </div>
        </a>

        <nav>
            <div class="nv nv1">
                <a href="index.php">Home</a>
            </div>

            <div class="nv nv1">
                <a href="#">Categories<i class='fas fa-angle-double-down'></i></a>
                <div class="dropDownList">
                    <ul>
                        <li><a href="web_dev.php">Web Development</a></li>
                        <li><a href="ml.php">Machine Learning</a></li>
                        <li><a href="dsa.php">Data Structures & Algorithms</a></li>
                    </ul>
                </div>
            </div>
            <div class="nv nv1">
                <a href="#">About</a>
            </div>
            <div class="nv nv1">
                <a href="#">Contact</a>
            </div>

            <?php if(isset($_SESSION["userid"])){ ?>
            <div class="nv nv1">
                <a href="#"><?php echo $_SESSION["username"];?><i class='fas fa-angle-double-down'></i></a>
                <div class="dropDownList">
                    <ul>
                        <li><a href="#">My Profile</a></li>
                        <li><a href="mylearning.php">My Learning</a></li>
                        <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
            </div>

            <div class="nv nv1">
                <a href="includes/logout.inc.php" style="color:brown; font-weight:700">logout</a>
            </div><?php }else{?>
                <div class="nv nv1">
                <a href="signup_log.php">Sign Up</a> 
            </div>

            <div class="nv nv1">
                <a href="signup_log.php">Log In</a> 
            </div><?php }?>                

        </nav>
    </header>

    <main>