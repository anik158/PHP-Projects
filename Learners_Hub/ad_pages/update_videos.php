<?php
session_start();

include_once "../includes/auto_loader.inc.php";
$pdo = new Dbh();

$conn = $pdo->connect();

$sql = "SELECT course_id,title FROM course";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

$sql1 = "SELECT video_id,title FROM video";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$rows1 = $stmt1->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ad_style.css">
    <link rel="icon" href="../img/favIcon.png" type="image/png">
    <title>Insert videos</title>

    <script>
         function confirmUpdate() {
            var confirmed = confirm("Are you sure you want to update?");
            return confirmed;
        }

        function validateForm() {
            var selectedCourse = document.getElementById("scourse").value;
            var title = document.getElementById("title").value;
            var description = document.getElementById("description").value;
            var category = document.getElementById("cat").value;
            var price = document.getElementById("price").value;
            var thumbnil = document.getElementById("thumbnil").value;

            if (selectedCourse === "" || title === "" || description === "" || category === "" || price === "" || !thumbnil) {
                alert("All fields are required.");
                return false;
            }

            return true;
        }
    </script>
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
        <h2 style="margin-left: 600px;color: coral;">Update Video</h2>
        <form action="../includes/update_ins_videos.inc.php" method="post" enctype="multipart/form-data"  onsubmit="return validateForm() &&  confirmUpdate()" >
        <label for="svid">Select Video</label>
            <select name="svid" id="vid">
                <?php foreach ($rows1 as $row1) { ?>
                    <option value="<?php echo $row1->video_id ?>"><?php echo $row1->video_id . "->" . $row1->title ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="title">Update Video Title</label>
            <input type="text" id="title" name="title">
            <label for="vid">Upload Video</label>
            <input type="file" id="vid" name="vid">
            <label for="scourse">Update Select Course</label>
            <select name="scourse" id="scourse">
                <?php foreach ($rows as $row) { ?>
                    <option value="<?php echo $row->course_id ?>"><?php echo $row->course_id . "->" . $row->title ?></option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" value="Add videos" name="upVid">
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