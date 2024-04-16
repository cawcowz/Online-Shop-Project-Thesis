<?php

class SignupController extends Signup
{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $user_id;

    public function __construct($uid,$pwd,$pwdRepeat,$email,$user_id){
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        $this->user_id = $user_id;
    }
    public function signupUser(){
        if($this->emptyInput() == false){
            // echo Empty input
            header("Location:signup.php?error=emptyinput");
            exit();
        }
        if($this->invalidUid() == false){
            header("Location:signup.php?error=username");
            exit();
        }
        if($this->invalidEmail() == false){
            header("Location:signup.php?error=email");
            exit();
        }
        if($this->pwdMath() == false){
            header("Location:signup.php?error=password not match");
            exit();
        }
        // if($this->uidTakenCheck() == true){
        //     header("Location:index.php?error=usernameTaken");
        //     exit();
        // }
        $this->setUser($this->uid,$this->pwd,$this->email,$this->user_id);
    }

    private function emptyInput(){
        $result;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidUid(){
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->uid)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    private function invalidEmail(){
        $result;
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function pwdMath(){
        $result;
        if($this->pwd !== $this->pwdRepeat){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    // private function uidTakenCheck(){
    //     $result;
        
    //     $stmt = $this->connect()->prepare('SELECT Username FROM login_table where Username=? , email=?');
    //     $stmt->execute(array($this->uid,$this->email));

    //     if($stmt->rowCount > 0){
    //         $result = true;
    //     }else{
    //         $result = false;
    //     }
    //     return $result;
    // }
}



