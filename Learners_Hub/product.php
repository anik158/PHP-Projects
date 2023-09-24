<?php

include_once "includes/header.inc.php";
include_once "includes/auto_loader.inc.php";

$pdo = new Dbh();
$conn = $pdo->connect();
$course_id = null;
$courseDetails = null;
$videoDetails  = null;
$usrID = null;
$count = 0;
if (isset($_GET['id'])) {
  $course_id = $_GET['id'];

  $sqlQuery = "SELECT * FROM course WHERE course_id = ?";
  $stmt = $conn->prepare($sqlQuery);
  
  if ($stmt->execute([$course_id])) {
      $courseDetails = $stmt->fetch();
  } else {
      die("Query execution failed: " . $stmt->errorInfo()[2]);
  }


  $sqlQuery1 = "SELECT * FROM video WHERE course_id = ?";
  $stmt1 = $conn->prepare($sqlQuery1);
  
  if ($stmt1->execute([$course_id])) {
      $videoDetails = $stmt1->fetchAll();
  } else {
      die("Query execution failed: " . $stmt1->errorInfo()[2]);
  }
}

if(isset($_SESSION["userid"])){
  $usrID = $_SESSION["userid"];
}


$sqlQuery2 = "SELECT * FROM user_course WHERE course_id = ? AND user_id=?";
$stmt2 = $conn->prepare($sqlQuery2);
$stmt2->execute([$course_id,$usrID]);
$returnIsTrue = false;
if($stmt2->rowCount()>0){
  $returnIsTrue = true;
} 

  

?>

<section class="index-banner_web">

</section>

<div class="container2">

  <div class="pro_image">
    <div class="pro_img">
    <img src="uploads/<?php echo $courseDetails->course_image;?>" alt="">
    </div>
  </div>

  <div class="pro_details">
    <?php if ($courseDetails) { ?>
      <div class="courseName">
        <h3>
          <?php echo $courseDetails->title; ?>
        </h3>
      </div>

      <div class="len">
        <h3>Length: 7 hours</h3>
      </div>

      <div class="onD">
        On demand
      </div>

      <div class="buttons">
        <form action="includes/process.inc.php" method="post">
          <input type="hidden" name="usrID" value="<?php echo $usrID; ?>">
          <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
          <button type="submit" class="wish" name="wishlist" <?php if (!isset($_SESSION["userid"]) || $returnIsTrue ==true) { echo 'disabled'; } ?>>Wishlist</button>
              &nbsp;
          <button type="submit" class="buy" name="buyButton" <?php if ($returnIsTrue ==true) { header("location: mylearning.php"); } ?>>Buy Now</button>
        </form>
</div>

    <?php } else { ?>
      <p>Course not found</p>
    <?php } ?>
  </div>




  <div class="table">
    <table>
      <tr>
        <th class="small-column">No</th>
        <th class="large-column">Contents</th>
        <th class="small-column">Duration</th>
      </tr>
      <?php foreach($videoDetails as $vidD){ $count++?>
      <tr>
        <td class="small-column"><?php echo $count?></td>
        <td class="large-column"><?php echo $vidD->title?></td>
        <td class="small-column">21 mins</td>
      </tr><?php }?>
    </table>
  </div>

</div>


<?php include_once "includes/footer.inc.php";