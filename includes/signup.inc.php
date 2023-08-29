<?php

if(isset($_POST["submit"])){

    //Grabbing the data
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];


    // Intantiate SignUp Controller Class

    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-controller.classes.php";

    $signUp = new SignUpContr($uid,$pwd,$pwdrepeat,$email);

    // Running  Error handlers and user signup
    $signUp->signUpUser();
    // Going to Back to Front Page
    header("location: ../index.php?error=none");
}