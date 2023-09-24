<?php 
include_once "../includes/auto_loader.inc.php";
class LoginAdController{
    protected $email;
    protected $pwd;
    protected $loginClass;
    public function __construct($email,$pwd){
        $this->email = $email;
        $this->pwd = $pwd;
        $this->loginClass = new LoginAd();
    }

    public function loginUser(){
        $this->loginClass->getUser($this->email,$this->pwd);
    }

}