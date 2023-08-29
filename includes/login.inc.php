<?php

if(isset($_POST["submit"])){

    //Grabbing the data
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    //$pwdrepeat = $_POST['pwdrepeat'];
    //$email = $_POST['email'];


    // Intantiate SignUp Controller Class

    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-controller.classes.php";

    $login = new LoginContr($uid,$pwd);

    // Running  Error handlers and user signup
    $login->loginUser();
    //header("location: ../index.php?error=none");
    
    // Going to Back to Front Page
    //header("location: ../loginsuc.php");
}