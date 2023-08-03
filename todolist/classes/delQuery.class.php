<?php 
/*
include_once "../includes/auto_load.inc.php";
class DelQuery{

    public function deleteTask($id){
        $pdo = new Dbh();
        $conn = $pdo->connect();
        $sql = "DELETE FROM tasks WHERE id = ?;";
       
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $this->updateRows($id);
        if(!$stmt->execute([$id])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

    }

    public function updateRows($id){
        $pdo = new Dbh();
        $conn = $pdo->connect();
        $queryFirst = "SELECT id FROM users ORDER BY id desc LIMIT 1;";
        $stmt = $conn->prepare($queryFirst);
        $maxLimit = $stmt->fetch();
        $minLimit = 1;

        if($id>$minLimit){
            $lowerID = $id;
            $lowerID++;
        }

        if($id>=$minLimit && $id<$maxLimit){
            $query = "UPDATE users SET id = id -1 WHERE id BETWEEN ? AND ?";
            $stmt2 = $conn->prepare($query);
            $stmt2->execute([$lowerID,$maxLimit->id]);
        }
    }
}*/


include_once "../includes/auto_load.inc.php";
class DelQuery{

    public function deleteTask($id){
        $pdo = new Dbh();
        $conn = $pdo->connect();
        $sql = "DELETE FROM tasks WHERE id = ?;";
       
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $this->updateRows($id);
        if(!$stmt->rowCount()){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

    }

    public function updateRows($id){
        $pdo = new Dbh();
        $conn = $pdo->connect();
        $queryFirst = "SELECT id FROM tasks ORDER BY id desc LIMIT 1;";
        $stmt = $conn->prepare($queryFirst);
        $stmt->execute();
        $maxLimit = $stmt->fetch();
        $minLimit = 1;
    
        if($id>=$minLimit){
            $lowerID = $id;
            $lowerID++;
            if($id>=$minLimit && $id<$maxLimit->id){
                $query = "UPDATE tasks SET id = id -1 WHERE id BETWEEN ? AND ?";
                $stmt2 = $conn->prepare($query);
                $stmt2->execute([$lowerID,$maxLimit->id]);
            }
        }
    }
    
}
