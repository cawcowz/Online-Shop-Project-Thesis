<?php
class UserController extends UDB
{
  
    public function getAddress($uid){
        $query = "SELECT * FROM users WHERE user_name = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($uid));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function setAddress($user,$pn,$address,$uid){
        $query = "UPDATE users SET Full_name = ? , phone_no = ? , address = ? WHERE user_name = ?";
        $stmt= $this->connect()->prepare($query);
        $stmt->execute(array($user,$this->setMobileNum($pn),$address,$uid));
        return $stmt;
    }
    public function setMobileNum($uid){
        $result;
        if(!preg_match("/^([0-9]{12})*$/",$uid)){
            if(strlen($uid) == 11){
                $result = $uid;
            }else{
                return $result = false;
            }
        }else{
            $result = false;
        }
        return $result;
    }
}