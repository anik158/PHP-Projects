<?php 

include_once "../includes/auto_loader.inc.php";
class InsUpdateController
{
     protected $coursID;
     protected $title;
     protected $description;
     protected $price;
     protected $category;
     protected $img;
     protected $update;

     public function __construct($coursID,$title,$description,$price,$category,$img)
     {
          $this->coursID = $coursID;
          $this->title = $title;
          $this->description = $description;
          $this->price = $price;
          $this->category = $category;
          $this->img = $img;

          $this->update = new UpdateInsertedCourse();
     }    

     public function updateCourse()
     {

          $this->update->updatedCourse($this->coursID, $this->title, $this->description, $this->price, $this->category ,$this->img);
     }

}