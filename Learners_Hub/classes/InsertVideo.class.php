<?php
include_once "../includes/auto_loader.inc.php";

class InsertVideo{
   protected $pdo;

   public function __construct(){
      $this->pdo = new Dbh();
   }
   

   public function addVideo($title, $vid, $coursID)
   {

      $fileName = $vid['name'];
      $fileTmpName = $vid['tmp_name'];
      $fileSize = $vid['size'];
      $fileError = $vid['error'];

      $fileExt = explode('.', $fileName);
      $fileExtension = strtolower(end($fileExt));

      $allowed = array('webm', 'mkv', 'avi','mp4');

      if (in_array($fileExtension, $allowed)) {

         if ($fileError === 0) {

            if ($fileSize < 9000000000) {
               $fileNewName = uniqid(' ', true) . "." . $fileExtension;
               $fileDestination = "../videos/".$fileNewName;
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
      $conn = $this->pdo->connect();
      $sqlFetch = "SELECT * FROM video ORDER BY video_id desc limit 1;";
        $stmt1 = $conn->prepare($sqlFetch);
        $stmt1->execute();
        $row = $stmt1->fetch();
        if($stmt1->rowCount()>0){
            $id = $row->video_id+1;
        }else{
            $id = 1;
        }
   
        $sqlQuery  = "INSERT INTO video(video_id,title,video_data,course_id) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sqlQuery);
        if(!$stmt->execute([$id,$title,$fileNewName,$coursID])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }else{
            $stmt = null;
            header("location: ../ad_pages/admin_panel.php?message=insertionvideosuccessful");
        }    

   }


   
}