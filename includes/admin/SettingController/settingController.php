<?php
class AdminSettingsController{
    
    public function database(){
        $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
        return $pdo;
    }
    public function displayAccount($user_id){
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt= $this->database()->prepare($query);
        $stmt->execute(array($user_id));
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datas;
    }
    public function updateUsername($username,$user_id){
        $query = "UPDATE users SET user_name = ? WHERE user_id = ?";
        $stmt = $this->database()->prepare($query);
        $stmt->execute(array($username,$user_id));
        return $stmt;
    }
    public function updateEmail($email,$user_id){
        $query = "UPDATE users SET email = ? WHERE user_id = ?";
        $stmt = $this->database()->prepare($query);
        $stmt->execute(array($email,$user_id));
        return $stmt;
    }
    public function displayImg($user_id){
        $query = "SELECT img FROM users WHERE user_id = ?";
        $stmt= $this->database()->prepare($query);
        $stmt->execute(array($user_id));
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datas;
    }
}