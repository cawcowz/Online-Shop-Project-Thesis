<?php
session_start();
if(isset($_POST['sendMessage'])){
    $myMessage = $_POST['sendMessage'];
    $user_id = $_SESSION['user_id'];
    $user = $_SESSION['fullname'];
   
        $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
        $query = "INSERT INTO chatbox(from_user,to_user,message,user_id) VALUES(?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($user,"BJLC",$myMessage,$user_id));
   

}