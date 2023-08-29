<?php

class SignUp extends Dbh{
 
    public function checkUser($uid,$email){
        $sql = "SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute([$uid,$email])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;

        if($stmt->rowCount() > 0){
            $resultCheck = false;
        }else{
            $resultCheck = true;
        }

        return $resultCheck;
    }

    public function setUser($uid,$pwd,$email){
        $sql = "INSERT INTO users(users_uid, users_pwd,users_email) VALUES (?,?,?);";
        $stmt = $this->connect()->prepare($sql);

        $hashPWD = password_hash($pwd,PASSWORD_DEFAULT);
        if(!$stmt->execute([$uid,$hashPWD,$email])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }


}

