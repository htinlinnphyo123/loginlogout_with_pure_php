<?php


    class MyDatabase {

        private $pdo;

        public function __construct($db,$host,$user,$password) {

            $dsn = "mysql:host=$host;dbname=$db;user=$user;password=$password";
            $this->pdo = new PDO($dsn);
        }

        public function query($query){
            
            try{
                $statement = $this->pdo->prepare($query);
                return $statement;
            }catch(PDOException $error){
                var_dump($error);
            }   
        }

        public function getId(){
            return $this->pdo->lastInsertId();
        }


    }



?>

