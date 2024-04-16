<?php

class Db{
    public function connect(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=inventory_system", 'root','');
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
           echo $e->getMessage();
        }
    }
}
?>