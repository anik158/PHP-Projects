<?php
class Dbh{
    protected function connect(){
        
        try{
            //Code 
            $host = "localhost";
            $user = "root";
            $password = "";
            $dbname = "loginsys";
            $dsn = "mysql:host=".$host.";dbname=".$dbname; 
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            return $pdo;
        }catch(PDOException $e){
            //throw $th
            print "Error!: ". $e->getMessage(). "<br/>";
            die();
        }
    }
}