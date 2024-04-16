<?php


if(isset($_POST['username'])){
    
    $username =$_POST['username'];
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = 'SELECT * FROM users WHERE user_name = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($username));

    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        echo "Invalid username";
    }
    if(strlen($username) <= 1 ){
        echo "Username must atleast 2 more character";
    }
    if($stmt->rowCount() > 0){
        echo "Username already exists";
    }

}