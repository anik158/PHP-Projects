<?php 
include_once "auto_loader.inc.php";

if(isset($_POST['addVid'])){
    
    //Grabbing the data
    $title = $_POST['title'];
    $vid = $_FILES['vid'];
    $coursID = $_POST['scourse'];

    //Instantiate Register Controller class
    $insCon = new InsertVidController($title,$vid,$coursID);

    //Running error handlers
    $insCon->insertVideos();
   
}
