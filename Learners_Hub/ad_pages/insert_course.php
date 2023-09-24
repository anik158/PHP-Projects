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
    <title>Insert Courses</title>
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
        <h2 style="margin-left: 600px;color: coral;">Insert Course</h2>
       <form action="../includes/ins_course.inc.php" method="post" enctype="multipart/form-data">
        <label for="courseID">Course ID</label>
        <input type="text" id="courseID" name="courseID">
        <label for="title">Title</label>
        <input type="text" id="title" name="title">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <label for="cat">Category</label>
         <select name="category" id="cat">
            <option value="Web Dev">Web Development</option>
            <option value="ML">Machine Learning</option>
            <option value="DSA">Data Structures & Algorithm</option>
         </select>
         <br>
         <label for="price">Price</label>
        <span>$</span><input type="text" id="price" name="price">
        <label for="thumbnil">Thumbnil</label>
        <input type="file" class="thumbnil" id="thumbnil" name="thumbnil">
        <br>
        <input type="submit" value="Submit" name="Insert">
        <a name="return" class="return" href="admin_panel.php">Return</a>
       </form>
    </main> <?php }
        else{?>
        <nav>
        <p class="title">Admin Panel</p>
        </nav>
        <a href="log_ad.php" style="margin-left:850px">Login First</a>
       <?php  }?>     
</body>
</html>