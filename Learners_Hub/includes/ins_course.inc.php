<?php 
include_once "auto_loader.inc.php";

if(isset($_POST['Insert'])){
    
    //Grabbing the data
    $coursID = $_POST['courseID'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $img = $_FILES['thumbnil'];

    //Instantiate Register Controller class
    $insCon = new InsController($coursID,$title,$description,$price,$category,$img);

    //Running error handlers
    $insCon->insertCourse();
}
