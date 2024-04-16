<?php 

class ProfileController 
{
    public function connect(){
        $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
        return $pdo;
    }
    public function displayHistory($user_id){
        $query = "SELECT * FROM history WHERE user_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($user_id));
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datas;
    }

    public function displayImage($user_id){
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($user_id));
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datas;
    }
}