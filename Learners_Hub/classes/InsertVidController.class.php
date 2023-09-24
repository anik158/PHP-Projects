<?php 

include_once "../includes/auto_loader.inc.php";
class InsertVidController{    
     protected $title;
     protected $vid;
     protected $coursID;
     protected $insertVid;

     public function __construct($title,$vid,$coursID)
     {
         $this->title = $title;
         $this->vid = $vid;
         $this->coursID = $coursID;
         $this->insertVid = new InsertVideo();
     }

     public function insertVideos()
     {

          $this->insertVid->addVideo($this->title, $this->vid, $this->coursID);
     }

}