<?php 
include_once "auto_loader.inc.php";

if(isset($_POST['del'])){
    
    //Grabbing the data
  
    $coursID = $_POST['dcourse'];

    $insCon = new DelCourseAdController($coursID);

    //Running error handlers
    $insCon->delCourses();
   
}
