<?php 

include_once "../includes/auto_loader.inc.php";
class MylearnInsertContr
{
     protected $courseID;
     protected $usrID;
     protected $insert;

     public function __construct($courseID,$usrID)
     {
          $this->courseID = $courseID;
          $this->usrID = $usrID;

          $this->insert = new MylearnInsert();
     }    

     public function insertCourseMyLearning()
     {

          $this->insert->addCourseMyL($this->courseID, $this->usrID);
     }

}