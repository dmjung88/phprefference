<?php
    $server = "localhost";
    $user="root";
    $password ="";
    $dbName ="test";
    $db = mysqli_connect($server, $user, $password, $dbName);
    if(!$db){
        echo  mysqli_connect_error();
    }

    abstract class DB {
        public function connect(){
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=test","kuzuro","1111");
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch (PDOException $e){
                echo "Connection Error ! ".$e->getMessage();
            }
        }
    }
?>