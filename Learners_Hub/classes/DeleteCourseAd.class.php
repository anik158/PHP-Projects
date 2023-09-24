<?php
include_once "../includes/auto_loader.inc.php";

class DeleteCourseAd{
   protected $pdo;

   public function __construct(){
      $this->pdo = new Dbh();
   }
   

   public function delCourse($coursID)
   {

      $conn = $this->pdo->connect();
     
   
        $sqlQuery  = "DELETE FROM course WHERE course_id = ?";
        $stmt = $conn->prepare($sqlQuery);
        if(!$stmt->execute([$coursID])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }else{
            $stmt = null;
            header("location: ../ad_pages/admin_panel.php?message=deletioncoursesuccessful");
        }    

   }


   
}