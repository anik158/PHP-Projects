<?php
session_start();
include_once "../includes/auto_loader.inc.php";
class Login{
 
    public function getUser($usr,$pwd){
        $pdo = new Dbh();
        $conn = $pdo->connect();
        $sql = "SELECT * FROM user WHERE username = ? OR email = ?;";
        $stmt = $conn->prepare($sql);

        if(!$stmt->execute([$usr,$usr])){
            $stmt = null;
            header("location: ../signup_log.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../signup_log.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetch();
        $checkPWD = password_verify($pwd,$pwdHashed->password);

        if($checkPWD == false){
            $stmt = null;
            header("location: ../signup_log.php?error=wrongpassword");
            exit();
        }elseif($checkPWD == true){
            $sql = "SELECT * FROM user WHERE username = ? OR email = ? AND password = ?;";
            $stmt = $conn->prepare($sql);

            if(!$stmt->execute([$usr,$usr,$pwd])){
                $stmt = null;
                header("location: ../signup_log.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../signup_log.php?error=usernotfound");
                exit();
            }

            if($stmt->rowCount()>0){
                $users = $stmt->fetchAll();

                foreach($users as $user){
                    $_SESSION["userid"] = $user->user_id;
                    $_SESSION["username"] = $user->username;
                    $_SESSION["email"] = $user->email;
                    $_SESSION["pwd"] = $user->password;

                    
                    setcookie("user_id", $user->user_id, time() + 3600, "/");
                    setcookie("username", $user->username, time() + 3600, "/");
                    setcookie("username", $user->email, time() + 3600, "/");
                }
                header("location: ../signup_log.php?error=none");
            }



            $stmt = null;


        }

        $stmt = null;
    }

    



}

