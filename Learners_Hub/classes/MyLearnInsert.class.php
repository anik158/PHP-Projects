<?php
include_once "../includes/auto_loader.inc.php";

class MylearnInsert{
   protected $pdo;

   public function __construct(){
      $this->pdo = new Dbh();
   }
   

   public function addCourseMyL($courseID, $usrID)
   {

   
      $conn = $this->pdo->connect();
      $sql = "INSERT INTO user_course(user_id,course_id) VALUES(?,?)";

      $stmt = $conn->prepare($sql);
      $stmt->execute([$usrID,$courseID]);
   }
}