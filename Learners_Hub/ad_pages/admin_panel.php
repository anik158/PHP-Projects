<?php 
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ad_style.css">
    <link rel="icon" href="../img/favIcon.png" type="image/png">
    <title>Admin Panel</title>
</head>
<body>

<?php if(isset($_SESSION["email"])){?>

    <nav>
        <p class="title">Admin Panel</p>
        <div class="adminName">
        <?php echo $_SESSION['username'];?>
                <div class="dropDownList">
                    <ul>
                        <li><a href="update_ad.php">Update Account</a></li>
                        <li><a href="logout_ad.php">Log Out</a></li>
                    </ul>
                </div>
        </div>
    </nav>

    <main>
        <div class="addcourse">
            <a href="insert_course.php">Add Courses</a>
        </div>

        <div class="addvid">
            <a href="insert_videos.php">Add Videos</a>
        </div>

        <div class="view">
            <a href="#">View Courses</a>
        </div>

        <div class="view">
            <a href="update_course.php">Update Courses</a>
        </div>

        <div class="view">
            <a href="update_videos.php">Update Videos</a>
        </div>
        <div class="delcourse">
            <a href="del_courses.php">Delete Courses</a>
        </div> 
    </main>  <?php }
        else{?>
        <nav>
        <p class="title">Admin Panel</p>
        </nav>
        <a href="log_ad.php" style="margin-left:850px">Login First</a>
       <?php  }?>  
</body>
</html>