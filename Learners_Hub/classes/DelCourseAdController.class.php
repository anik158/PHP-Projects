<?php 

include_once "../includes/auto_loader.inc.php";
class DelCourseAdController{    
    protected $coursID;
    protected $delVid;
     public function __construct($coursID)
     {
         $this->coursID = $coursID;
         $this->delVid = new DeleteCourseAd();
     }

     public function delCourses()
     {

          $this->delVid->delCourse($this->coursID);
     }

}