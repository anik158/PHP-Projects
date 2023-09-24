<?php
include_once "../includes/auto_loader.inc.php";

class SignUpContr{
    private $usr;
    private $pwd;
    private $pwdrepeat;
    private $email;
    private $bal;
    private $pimg;
    private $signupClass;

    public function __construct($usr,$pwd,$pwdrepeat,$email,$bal,$pimg){
        $this->usr = $usr;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
        $this->bal = $bal;
        $this->pimg = $pimg;
        $this->signupClass = new SignUp();
    }

    public function signUpUser(){
        if($this->emptyInput()==false){
            // echo "Empty input";
            header("location: ../signup_log.php?error=emptyinput");
            exit();
        }

        
        if($this->invalidUid()==false){
            // echo "Invalid username";
            header("location: ../signup_log.php?error=username");
            exit();
        }

        if($this->invalidEmail()==false){
            // echo "Invalid email";
            header("location: ../signup_log.php?error=email");
            exit();
        }

        if($this->pwdMatch()==false){
            // echo "Password doesn't match";
            header("location: ../signup_log.php?error=passwordmatch");
            exit();
        }

        if($this->uidTakenCheck()==false){
            // echo "Username or email taken";
            header("location: ../signup_log.php?error=useroremailtaken");
            exit();
        }

        $this->signupClass->setUser($this->usr,$this->pwd,$this->email,$this->bal,$this->pimg);
    }

    private function emptyInput(){
        $result = true;
        if(empty($this->usr) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email) || empty($this->bal)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }


    private function invalidUid(){
        $result = false;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->usr)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function isValidPassword(){
        $pattern = "/^(?=.*[A-Z])(?=.*\d).{8,16}$/";

        if(preg_match($pattern, $this->pwd)){
            return true; 
        } else {
            return false; 
        }
    }
    

    private function invalidEmail(){
        $result = false;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
        $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

   

    private function pwdMatch(){
        $result = false;

        if($this->pwd !== $this->pwdrepeat){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function uidTakenCheck(){
        $result = false;

        if(!$this->signupClass->checkUser($this->usr,$this->email)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

}

