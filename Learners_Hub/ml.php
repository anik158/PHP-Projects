<?php include_once "includes/header.inc.php";?>
<?php 
    include_once "includes/auto_loader.inc.php";
    $pdo = new Dbh();
    $conn = $pdo->connect();
    $cat2 = "ML";

    $sqlQuery2 = "SELECT * FROM course WHERE category=?;";
    $stmt2 = $conn->prepare($sqlQuery2);
    $stmt2->execute([$cat2]);
    $rows2 = $stmt2->fetchAll();


?>
        <section class="index-banner_ml">
           
        </section>

        <div class="container">
            <h3>Machine Learning</h3>
            <div class="secondSection">
                <?php foreach($rows2 as $row2){?>
                <div class="courseOne">
                    <div class="cover">
                    <a class="thum" href="product.php?id=<?php echo $row2->course_id ?>"> 
                            <img src="uploads/<?php echo $row2->course_image?>" width="300px" height="200px" alt="thumbnill_640">
                            
                            <div class="price"><h4 class="pText"><?php echo "$ ".$row2->price?></h4></div>
                        </a>
                    </div>


                    <div class="courseTitle">
                        <h4><?php echo $row2->title?></h4>
                    </div>
                </div><?php }?>

            </div>
        

<?php include_once "includes/footer.inc.php";