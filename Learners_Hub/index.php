
<?php include_once "includes/header.inc.php";?>
<?php 
    include_once "includes/auto_loader.inc.php";
    $pdo = new Dbh();
    $conn = $pdo->connect();
    $cat1 = "Web Dev";
    $cat2 = "ML";
    $cat3 = "DSA";

    $sqlQuery = "SELECT * FROM course WHERE category=? limit 3;";
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute([$cat1]);
    $rows = $stmt->fetchAll();

    $sqlQuery2 = "SELECT * FROM course WHERE category=? limit 3;";
    $stmt2 = $conn->prepare($sqlQuery2);
    $stmt2->execute([$cat2]);
    $rows2 = $stmt2->fetchAll();

    $sqlQuery3 = "SELECT * FROM course WHERE category=? limit 3;";
    $stmt3 = $conn->prepare($sqlQuery3);
    $stmt3->execute([$cat3]);
    $rows3 = $stmt3->fetchAll();

?>

<section class="index-banner">
    <div class="vertical-center">
        <h2>ARE YOU<br> READY <br>TO <br> BECOME <br>A<br> SOFTWARE DEVELOPER?</h2>
        <h1>With speciality in back-end development, functionality, UX design, and Data Stuctures & Algorithms</h1>
    </div>
</section>

        <div class="container">
            <h3>Web Development</h3>
            <div class="firstSection">
                <?php foreach($rows as $row){?>
                <div class="courseOne">
                    <div class="cover">
                    <a class="thum" href="product.php?id=<?php echo $row->course_id ?>"> 
                            <img src="uploads/<?php echo $row->course_image?>" width="300px" height="200px" alt="thumbnill_640">
                            
                            <div class="price"><h4 class="pText"><?php echo "$ ".$row->price?></h4></div>
                        </a>
                    </div>


                    <div class="courseTitle">
                        <h4><?php echo $row->title?></h4>
                    </div>
                </div><?php }?>


                <div class="more">
                    <div class="cover">
                        <a class="thum" href="web_dev.php"> 
                            <img src="img/more.png" width="300px" height="200px" alt="more">
                            
                            <div class="price"><h4 class="pText">More</h4></div>
                        </a>
                    </div>


                    <div class="courseTitle">
                        <h4>More</h4>
                    </div>
                </div>
            </div>

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



                <div class="more">
                    <div class="cover">
                        <a class="thum" href="ml.php"> 
                            <img src="img/more.png" width="300px" height="200px" alt="more">
                            
                            <div class="price"><h4 class="pText">More</h4></div>
                        </a>
                    </div>


                    <div class="courseTitle">
                        <h4>More</h4>
                    </div>
                </div>
            </div>

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


                <div class="more">
                    <div class="cover">
                        <a class="thum" href="dsa.php"> 
                            <img src="img/more.png" width="300px" height="200px" alt="more">
                            
                            <div class="price"><h4 class="pText">More</h4></div>
                        </a>
                    </div>


                    <div class="courseTitle">
                        <h4>More</h4>
                    </div>
                </div>
            </div>
        </div>
        
<?php include_once "includes/footer.inc.php"?>