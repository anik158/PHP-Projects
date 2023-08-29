<?php 
include_once "../includes/auto_load.inc.php";
class Insert{

    protected $title;
    protected $task;
    public function __construct($title,$task){
        $this->title = $title;
        $this->task = $task;
    }

    private function emptyInput(){
        $result = true;
        if(empty($this->title) || empty($this->task)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function taskTakenCheck(){
        $insertion = new InsertionQuery();
        $result = false;

        if(!$insertion->checkTask($this->title,$this->task)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    public function taskSet(){
        if($this->emptyInput()==false){
            header("location: ../index.php?error=emptyInput");
        }
        
        if($this->taskTakenCheck()==false){
            header("location: ../index.php?error=tasktaken");
        }

        $insertion = new InsertionQuery();
        $insertion->setTask($this->title,$this->task);
    }

}