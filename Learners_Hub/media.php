
<?php include_once "includes/header.inc.php";?>
<?php 
if(isset($_SESSION["userid"])){
    include_once "includes/auto_loader.inc.php";
    $pdo = new Dbh();
    $conn = $pdo->connect();

    $usrID = $_SESSION['userid'];

    $vid_id = null;
    if (isset($_GET['id'])) {
        $vid_id = $_GET['id'];
      
        $sqlQuery = "SELECT * FROM video WHERE video_id = ?";
        $stmt = $conn->prepare($sqlQuery);
        
        if ($stmt->execute([$vid_id])) {
            $videoDetails = $stmt->fetch();
        } else {
            die("Query execution failed: " . $stmt->errorInfo()[2]);
        }
    }

?>

<section class="index-banner">
    <div class="vertical-center">
        <h2>ARE YOU<br> READY <br>TO <br> BECOME <br>A<br> SOFTWARE DEVELOPER?</h2>
        <h1>With speciality in back-end development, functionality, UX design, and Data Stuctures & Algorithms</h1>
    </div>
</section>

        <div class="container">
            <h3><?php echo $videoDetails->title;?></h3>

               
            <div style="margin-left: 300px;">
                <video controls width="70%" height="60%">
                    <source src="videos/<?php echo $videoDetails->video_data;?>">
                </video>
            </div>

        </div>
        
<?php include_once "includes/footer.inc.php"?> <?php }else{

    header("location: index.php");
}?>