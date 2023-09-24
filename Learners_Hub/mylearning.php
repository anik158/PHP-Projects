
<?php include_once "includes/header.inc.php";?>
<?php 
    include_once "includes/auto_loader.inc.php";
    $pdo = new Dbh();
    $conn = $pdo->connect();
    
    if(isset($_SESSION["userid"])){

    $usrID = $_SESSION['userid'];

    $sql = "SELECT * FROM course
                INNER JOIN user_course ON course.course_id = user_course.course_id
                WHERE user_course.user_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usrID]);
    $rows = $stmt->fetchAll();

?>

<section class="index-banner">
    <div class="vertical-center">
        <h2>ARE YOU<br> READY <br>TO <br> BECOME <br>A<br> SOFTWARE DEVELOPER?</h2>
        <h1>With speciality in back-end development, functionality, UX design, and Data Stuctures & Algorithms</h1>
    </div>
</section>

        <div class="container">
            <h3>My Learning</h3>
            <div class="firstSection">
                <?php foreach($rows as $row){?>
                <div class="courseOne">
                    <div class="cover">
                    <a class="thum" href="product_details.php?id=<?php echo $row->course_id ?>"> 
                            <img src="uploads/<?php echo $row->course_image?>" width="300px" height="200px" alt="thumbnill_640">
                            
                            <div class="price"><h4 class="pText"><?php echo "$ ".$row->price?></h4></div>
                        </a>
                    </div>


                    <div class="courseTitle">
                        <h4><?php echo $row->title?></h4>
                    </div>
                </div><?php }?>
            </div>
        </div>
        
<?php include_once "includes/footer.inc.php"?> <?php }else{
    header("location: index.php");
}?>