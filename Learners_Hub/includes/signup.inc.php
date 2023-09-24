<?php
include_once "auto_loader.inc.php";
if(isset($_POST["submit"])){

    //Grabbing the data
    $usr = $_POST['usr'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];
    $bal = $_POST['balance'];
    $pimg = $_FILES['thumbnil'];
    $signUp = new SignUpContr($usr,$pwd,$pwdrepeat,$email,$bal,$pimg);

    // Running  Error handlers and user signup
    $signUp->signUpUser();
    // Going to Back to Front Page
    header("location: ../index.php?error=none");
}