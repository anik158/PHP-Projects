<?php
include_once("signup.classes.php");

class SignUpContr{
    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;
    private $signupClass;

    public function __construct($uid,$pwd,$pwdrepeat,$email){
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
        $this->signupClass = new SignUp();
    }

    public function signUpUser(){
        if($this->emptyInput()==false){
            // echo "Empty input";
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        
        if($this->invalidUid()==false){
            // echo "Invalid username";
            header("location: ../index.php?error=username");
            exit();
        }

        if($this->invalidEmail()==false){
            // echo "Invalid email";
            header("location: ../index.php?error=email");
            exit();
        }

        if($this->pwdMatch()==false){
            // echo "Password doesn't match";
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        if($this->uidTakenCheck()==false){
            // echo "Username or email taken";
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        $this->signupClass->setUser($this->uid,$this->pwd,$this->email);
    }

    private function emptyInput(){
        $result = true;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }


    private function invalidUid(){
        $result = false;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->uid)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
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

        if(!$this->signupClass->checkUser($this->uid,$this->email)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

}

