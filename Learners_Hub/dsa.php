<?php include_once "includes/header.inc.php";?>

<?php 
    include_once "includes/auto_loader.inc.php";
    $pdo = new Dbh();
    $conn = $pdo->connect();
    $cat3 = "DSA";
    $sqlQuery3 = "SELECT * FROM course WHERE category=?;";
    $stmt3 = $conn->prepare($sqlQuery3);
    $stmt3->execute([$cat3]);
    $rows3 = $stmt3->fetchAll();

?>
        <section class="index-banner_dsa">
           
        </section>

        <div class="container">
            <h3 >Data Structures & Algorithms</h3>
            <div class="thirdSection">
            <?php foreach($rows3 as $row3){?>
                <div class="courseOne">
                    <div class="cover">
                    <a class="thum" href="product.php?id=<?php echo $row3->course_id ?>"> 
                            <img src="uploads/<?php echo $row3->course_image?>" width="300px" height="200px" alt="thumbnill_640">
                            
                            <div class="price"><h4 class="pText"><?php echo "$ ".$row3->price?></h4></div>
                        </a>
                    </div>


                    <div class="courseTitle">
                        <h4><?php echo $row3->title?></h4>
                    </div>
                </div><?php }?>
            </div>

  <?php include_once "includes/footer.inc.php";