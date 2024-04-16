<?php
if(isset($_POST['username'])){
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $account_type = $_POST['account_type'];
    
    if(empty($username) || empty($email) || empty($password) || empty($confirm_password) ){
        echo "*Fill out all field";
        exit;
    }
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        echo "*Invalid username";
        exit;
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "*Invalid email";
        exit;
    }
    if(strlen($password) < 8 ){
        echo "*Password must contain of 8 or more characters";
        exit;
    }
    if($password != $confirm_password){
        echo "*Password did not match";
        exit;
    }
    $query = "INSERT INTO users(user_name,pwd,email,is_admin) VALUES(?,?,?,?) ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($username,$password,$email,$account_type));
    echo "Successfully added";

}