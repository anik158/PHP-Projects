<?php
session_start();
include_once "../includes/auto_loader.inc.php";
class LoginAd{

    protected $pdo;
    public function __construct(){
        $this->pdo = new Dbh();
    }


    public function getUser($email,$pwd){

        $conn = $this->pdo->connect();
        
               
        $sql = "SELECT * FROM admin WHERE email = ? OR username = ?";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute([$email, $email]);

        $user = $stmt->fetch();
    
        if($user === false){
            header("location: ../ad_pages/admin_panel.php?error=nouserfound");
            exit();
        }else{

            if(password_verify($pwd, $user->password)){
                $_SESSION["id"] = $user->admin_id;
                $_SESSION["email"] = $user->email;
                $_SESSION["username"] = $user->username;
                header("location: ../ad_pages/admin_panel.php?login=success");
                exit();
            }else{
                header("location: ../ad_pages/admin_panel.php?error=passwordnotmatch");
                exit();
            }
            
        }

    }
   
}