<?php

    class Dbh{
        protected $host = "localhost";
        protected $user = "root";
        protected $password = "";
        protected $dbname = "todolist";

        public function connect(){
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;
            try{
                $pdo = new PDO($dsn, $this->user, $this->password);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }catch(PDOException $e){
                $e->getMessage();
                die();
            }
        }

       

    }

?>
