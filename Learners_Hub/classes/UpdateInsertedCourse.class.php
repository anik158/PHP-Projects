<?php
include_once "../includes/auto_loader.inc.php";

class UpdateInsertedCourse{
   protected $pdo;

   public function __construct(){
      $this->pdo = new Dbh();
   }
   



   public function updatedCourse($courseID, $title, $description, $price, $category, $img)
{
   $fileName = $img['name'];
   $fileTmpName = $img['tmp_name'];
   $fileSize = $img['size'];
   $fileError = $img['error'];

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

    $conn = $this->pdo->connect();
    $sql = "UPDATE course SET title=?, description=?, price=?, category=?, course_image=? WHERE course_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $description, $price, $category, $fileNewName, $courseID]);

    header("location: ../ad_pages/admin_panel.php?message=updatesuccessful");
}

}