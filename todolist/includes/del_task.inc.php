<?php 
include_once "auto_load.inc.php";
if(isset($_POST['del'])){

    //Grab Data
    $row_id = $_POST['row_id'];

    $deltask = new delTask($row_id);
    $deltask->taskDel();
    header("location: ../index.php?error=none");

}