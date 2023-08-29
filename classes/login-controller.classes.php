<?php
//include_once("login.classes.php");

class LoginContr extends Login{
    private $uid;
    private $pwd;
   // private $loginClass;

    public function __construct($uid,$pwd){
        $this->uid = $uid;
        $this->pwd = $pwd;
       // $this->loginClass = new Login();
    }

    public function loginUser(){
        if($this->emptyInput()==false){
            // echo "Empty input";
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->uid,$this->pwd);
    }

    private function emptyInput(){
        $result = true;
        if(empty($this->uid) || empty($this->pwd)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }
}

