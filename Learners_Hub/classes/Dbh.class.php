<?php

class Dbh{
    protected $host = "localhost";
    protected $user = "root";
    protected $pwd = "";
    protected $dbName = "learnershub";

    public function connect(){
        try{
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            
            $pdo = new PDO($dsn,$this->user,$this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
            return $pdo;
        }catch(PDOException $e){
            echo "error is: ".$e;
        }
    }
}