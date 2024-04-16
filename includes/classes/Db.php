<?php


class Dbh{
    public function connect(){
        $user = "root";
        $pass = '';
        try{
            $db = new PDO("mysql:host=localhost;dbname=inventory_system;",$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $db;
            // echo "Connected";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
