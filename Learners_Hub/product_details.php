<?php

include_once "includes/header.inc.php";
if(isset($_SESSION["userid"])){
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

?>

<section class="index-banner_web">

</section>

<div class="container2">

  <div class="pro_image">
    <div class="pro_img">
    <img src="uploads/<?php echo $courseDetails->course_image;?>" alt="">
    </div>
    <p>
    <?php echo $courseDetails->description;?>
    </p>
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
        <td class="small-column"><a href="media.php?id=<?php echo $vidD->video_id; ?>" target="_blank"><?php echo $count?></a></td>
        <td class="large-column"><a href="media.php?id=<?php echo $vidD->video_id; ?>" target="_blank"><?php echo $vidD->title?></a></td>
        <td class="small-column"><a href="media.php?id=<?php echo $vidD->video_id; ?>" target="_blank">21 mins</a></td>
      </tr><?php }?>
    </table>
  </div>

</div>


<?php include_once "includes/footer.inc.php";?><?php }else{

  header("location: index.php");
}?>