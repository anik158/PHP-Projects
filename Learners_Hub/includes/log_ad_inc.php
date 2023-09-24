<?php
session_start();
include_once "auto_loader.inc.php";
if(isset($_SESSION['email'])){
    header("location: ../ad_pages/admin_panel.php");
}
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $logAdCon = new LoginAdController($email,$pwd);
    $logAdCon->loginUser();

}
