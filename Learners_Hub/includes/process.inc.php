<?php 
session_start();
include_once "auto_loader.inc.php";
if(isset($_POST["buyButton"])){
    if (!isset($_SESSION["userid"]) || $returnIsTrue ==true){
         header("location: ../signup_log.php"); 
    }

    $courseID = $_POST["course_id"];
    $usrID = $_POST["usrID"];

    $buy = new MylearnInsertContr($courseID,$usrID);
    $buy->insertCourseMyLearning();
    header("location: ../index.php?message=courseAdded");
}