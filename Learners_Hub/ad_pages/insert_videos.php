<?php
session_start();

include_once "../includes/auto_loader.inc.php";
$pdo = new Dbh();

$conn = $pdo->connect();

$sql = "SELECT course_id,title FROM course";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ad_style.css">
    <link rel="icon" href="../img/favIcon.png" type="image/png">
    <title>Insert videos</title>
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
        <h2 style="margin-left: 600px;color: coral;">Insert Video</h2>
        <form action="../includes/ins_videos.inc.php" method="post" enctype="multipart/form-data">
            <label for="title">Video Title</label>
            <input type="text" id="title" name="title">
            <label for="vid">Upload Video</label>
            <input type="file" id="vid" name="vid">
            <label for="scourse">Select Course</label>
            <select name="scourse" id="scourse">
                <?php foreach ($rows as $row) { ?>
                    <option value="<?php echo $row->course_id ?>"><?php echo $row->course_id . "->" . $row->title ?></option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" value="Add videos" name="addVid">
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