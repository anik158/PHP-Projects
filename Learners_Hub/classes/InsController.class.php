<?php 

include_once "../includes/auto_loader.inc.php";
class InsController
{
     protected $coursID;
     protected $title;
     protected $description;
     protected $price;
     protected $category;
     protected $img;
     protected $insert;

     public function __construct($coursID,$title,$description,$price,$category,$img)
     {
          $this->coursID = $coursID;
          $this->title = $title;
          $this->description = $description;
          $this->price = $price;
          $this->category = $category;
          $this->img = $img;

          $this->insert = new InsertCourse();
     }    

     public function insertCourse()
     {

          $this->insert->addCourse($this->coursID, $this->title, $this->description, $this->price, $this->category ,$this->img);
     }

}