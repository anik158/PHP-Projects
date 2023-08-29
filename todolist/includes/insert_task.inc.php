<?php 

include "auto_load.inc.php";

if(isset($_POST['submit'])){

    //Grab Values
    $title = $_POST['title'];
    $task = $_POST['task'];

    $instTask = new Insert($title,$task);
    $instTask->taskSet();
    header("location: ../index.php?error=none");
}

