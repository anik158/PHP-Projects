<?php 
include_once "../includes/auto_load.inc.php";
class delTask{

    protected $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function taskDel(){
        $delQuery = new delQuery();

        $delQuery->deleteTask($this->id);
    }
}