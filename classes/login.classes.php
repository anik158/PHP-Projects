<?php
session_start();
class Login extends Dbh{
 
    public function getUser($uid,$pwd){
        $sql = "SELECT * FROM users WHERE users_uid = ? OR users_email = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute([$uid,$uid])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetch(PDO::FETCH_OBJ);
        $checkPWD = password_verify($pwd,$pwdHashed->users_pwd);

        if($checkPWD == false){
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }elseif($checkPWD == true){
            $sql = "SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;";
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute([$uid,$uid,$pwd])){
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            if($stmt->rowCount()>0){
                $users = $stmt->fetchAll(PDO::FETCH_OBJ);

                foreach($users as $user){
                    $_SESSION["userid"] = $user->users_id;
                    $_SESSION["useruid"] = $user->users_uid;
                }
                header("location: ../index.php?error=none");
            }



            $stmt = null;


        }

        $stmt = null;
    }

    



}

