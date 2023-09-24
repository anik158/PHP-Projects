<?php
include_once "../includes/auto_loader.inc.php";
if(isset($_POST["submit"])){

    //Grabbing the data
    $uid = $_POST['usr'];
    $pwd = $_POST['pwd'];


    // Intantiate SignUp Controller Class

    $login = new LoginContr($uid,$pwd);

    // Running  Error handlers and user signup
    $login->loginUser();
    header("location: ../index.php?error=none");
    
}