<?php

class SignUp extends Dbh{
 
    public function checkUser($usr,$email){
        $sql = "SELECT user_id FROM user WHERE username = ? OR email = ?;";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute([$usr,$email])){
            $stmt = null;
            header("location: ../signup_log.php?error=stmtfailed");
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

    public function setUser($usr,$pwd,$email,$bal,$pimg){

        $fileName = $pimg['name'];
      $fileTmpName = $pimg['tmp_name'];
      $fileSize = $pimg['size'];
      $fileError = $pimg['error'];

      $fileExt = explode('.', $fileName);
      $fileExtension = strtolower(end($fileExt));

      $allowed = array('jpg', 'jpeg', 'png');

      if (in_array($fileExtension, $allowed)) {

         if ($fileError === 0) {

            if ($fileSize < 10000000) {
               $fileNewName = uniqid(' ', true) . "." . $fileExtension;
               $fileDestination = "../uploads/".$fileNewName;
               move_uploaded_file($fileTmpName, $fileDestination);
            } else {
               echo "Your file is too Big";
            }

         } else {
            echo "There was an error while uploading your file.";
         }

      } else {
         echo "You cannot upload files of this type";
      }

      $id=0;
      $conn = $this->connect();
      $sqlFetch = "SELECT * FROM user ORDER BY user_id desc limit 1;";
        $stmt1 = $conn->prepare($sqlFetch);
        $stmt1->execute();
        $row = $stmt1->fetch();
        if($stmt1->rowCount()>0){
            $id = $row->user_id+1;
        }else{
            $id = 1;
        }

        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user(user_id, username,password,email,balance,profile_img) VALUES (?,?,?,?,?,?);";
        $stmt = $this->connect()->prepare($sql);

        $hashPWD = password_hash($pwd,PASSWORD_DEFAULT);
        if(!$stmt->execute([$id,$usr,$hashedPassword,$email,$bal,$fileNewName])){
            $stmt = null;
            header("location: ../signup_log.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }


}

