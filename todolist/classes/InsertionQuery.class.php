<?php 
include_once "../includes/auto_load.inc.php";
class InsertionQuery{


    public function checkTask($title,$task){
        $sqlQuery = "SELECT * FROM tasks WHERE title LIKE ? AND task LIKE ?;";
        $dbh = new Dbh();
        $conn = $dbh->connect();
        $stmt = $conn->prepare($sqlQuery);

        if(!$stmt->execute([$title,$task])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck  = false;
        if($stmt->rowCount()>0){
            $resultCheck = false;
        }else{
            $resultCheck = true;
        }

        return $resultCheck;
    }

    public function setTask($title,$task){
        $dbh = new Dbh();
        $conn = $dbh->connect();

        $sqlFetch = "SELECT id FROM tasks ORDER BY id desc limit 1;";
        $stmt1 = $conn->prepare($sqlFetch);
        $stmt1->execute();
        $row = $stmt1->fetch();
        if($stmt1->rowCount()>0){
            $id = $row->id+1;
        }else{
            $id = 1;
        }
        $currentDate = date('Y-m-d');
        $sqlQuery  = "INSERT INTO tasks(id,title,task,created_at) VALUES (?,?,?,?);";
        $stmt = $conn->prepare($sqlQuery);
        if(!$stmt->execute([$id,$title,$task,$currentDate])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

}