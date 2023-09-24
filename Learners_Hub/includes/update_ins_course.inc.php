<?php 
include_once "auto_loader.inc.php";

if(isset($_POST['update'])){
    
    //Grabbing the data
    $coursID = $_POST['scourse'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $img = $_FILES['thumbnil'];

    //Instantiate Register Controller class
    $insCon = new InsUpdateController($coursID,$title,$description,$price,$category,$img);

    //Running error handlers
    $insCon->updateCourse();
}
