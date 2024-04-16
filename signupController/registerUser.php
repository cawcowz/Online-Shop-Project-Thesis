<?php

if(isset($_POST['user']) && isset($_POST['password']) && isset($_POST['passwordR']) && isset($_POST['email'])){
    $email = $_POST['email'];
    // echo $email;
    $user = $_POST['user'];
    $password = $_POST['password'];
    $passwordR = $_POST['passwordR'];

    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");

    function signupUser($email,$user,$password, $passwordR,$pdo){
        if(invalidEmail($email) == false){
            return "*Invalid Email address";
            exit;
        }
        if(invalidUid($user) == false){
            return "*Invalid username";
            exit;
        }
        if(userLength($user) == false){
            return "*Username must contain of 2 or more characters";
            exit;
        }
        if(pwdLength($password) == false){
            return "*Password must contain of 8 or more characters";
            exit;
        }
        if(checkPwd($password , $passwordR) == false){
            return "*Password didn't match";
            exit;
        }

        if(verifyUser($user,$pdo)== true){
            return '*Opps! Looks like this account is already exists!';
            exit;
        }
        $query = 'INSERT INTO users(email,user_name,pwd,user_id) VALUES(?,?,?,?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($email,$user,$password,"USER".uniqid()));
        return 'Successfully Register';
        }
 
    // Controllers
    function InvalidEmail($email){
        $result;
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    };
    function invalidUid($user){
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$user)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    function userLength($user){
        $result;
        $userTrim = str_replace(' ', ' ',$user); 
        if(strlen($userTrim) < 2 ){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    function pwdLength($password){
        $result;
        $pwdTrim =str_replace(' ', ' ',$password); 
        if(strlen($pwdTrim) < 8 ){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    function checkPwd($password , $passwordR){
        $result;
        $pwdTrim =str_replace(' ', ' ',$password); 
        $pwdRTrim =str_replace(' ', ' ',$passwordR); 
        if($pwdTrim != $pwdRTrim){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    function verifyUser($user,$pdo ){
        $query = 'SELECT * FROM users WHERE user_name = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($user));
        $result;
        if($stmt->rowCount() > 0){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    echo signupUser($email,$user,$password,$passwordR,$pdo);

}
