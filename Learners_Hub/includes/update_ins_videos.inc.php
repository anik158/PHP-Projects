<?php 
include_once "auto_loader.inc.php";

if(isset($_POST['upVid'])){
    
    //Grabbing the data
    $vidID = $_POST['svid'];
    $title = $_POST['title'];
    $vid = $_FILES['vid'];
    $coursID = $_POST['scourse'];

    //Instantiate Register Controller class
    $insCon = new UpdateVidController($vidID,$title,$vid,$coursID);

    //Running error handlers
    $insCon->updateVideos();
   
}
