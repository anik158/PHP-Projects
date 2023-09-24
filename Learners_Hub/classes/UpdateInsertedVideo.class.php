<?php
include_once "../includes/auto_loader.inc.php";

class UpdateInsertedVideo{
   protected $pdo;

   public function __construct(){
      $this->pdo = new Dbh();
   }
   

   public function updateVideo($videoID, $title, $vid, $coursID)
{
    $fileName = $vid['name'];
    $fileTmpName = $vid['tmp_name'];
    $fileSize = $vid['size'];
    $fileError = $vid['error'];

    $fileExt = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExt));

    $allowed = array('webm', 'mkv', 'avi', 'mp4');

    if (in_array($fileExtension, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 9000000000) {
                $fileNewName = uniqid(' ', true) . "." . $fileExtension;
                $fileDestination = "../videos/" . $fileNewName;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo "Your file is too big";
                return; // Exit the function if the file is too big
            }
        } else {
            echo "There was an error while uploading your file.";
            return; // Exit the function if there was an error uploading the file
        }
    } else {
        echo "You cannot upload files of this type.";
        return; // Exit the function if the file type is not allowed
    }

    $conn = $this->pdo->connect();

    $sql = "UPDATE video SET title=?, video_data=?, course_id=? WHERE video_id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt->execute([$title, $fileNewName, $coursID, $videoID])) {
        $stmt = null;
        header("location: ../index.php?error=stmtfailed");
        exit();
    } else {
        $stmt = null;
        header("location: ../ad_pages/admin_panel.php?message=updatevideosuccessful");
    }
}



   
}