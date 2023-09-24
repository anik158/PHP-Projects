<?php
include_once "../includes/auto_loader.inc.php";

class LoginContr{
    protected $usr;
    protected $pwd;
    protected $loginClass;

    public function __construct($usr,$pwd){
        $this->usr = $usr;
        $this->pwd = $pwd;
       $this->loginClass = new Login();
    }

    public function loginUser(){
        if($this->emptyInput()==false){
            // echo "Empty input";
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        $this->loginClass->getUser($this->usr,$this->pwd);
    }

    private function emptyInput(){
        $result = true;
        if(empty($this->usr) || empty($this->pwd)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }
}

