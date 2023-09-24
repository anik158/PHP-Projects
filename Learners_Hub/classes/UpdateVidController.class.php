<?php 

include_once "../includes/auto_loader.inc.php";
class UpdateVidController{    

     protected $videoID;
     protected $title;
     protected $vid;
     protected $coursID;
     protected $insertVid;

     public function __construct($videoID,$title,$vid,$coursID)
     {
         $this->videoID = $videoID; 
         $this->title = $title;
         $this->vid = $vid;
         $this->coursID = $coursID;
         $this->insertVid = new UpdateInsertedVideo();
     }

     public function updateVideos()
     {
          $this->insertVid->updateVideo($this->videoID, $this->title, $this->vid, $this->coursID);
     }

}