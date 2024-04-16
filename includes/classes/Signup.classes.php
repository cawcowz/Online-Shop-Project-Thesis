<?php

class Signup extends Dbh{

    public function setUser($uid,$pwd,$email,$user_id){
        $stmt = $this->connect()->prepare('INSERT INTO users (user_name,pwd,email,user_id) VALUES(?,?,?,?)');

        // $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
        if(!$stmt->execute(array($uid,$pwd,$email,$user_id))){
            $stmt = null;
            header("location : index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;

    }
}