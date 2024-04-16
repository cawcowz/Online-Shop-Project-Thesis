<?php
session_start();
if(isset($_POST['sendMessage'])){
    $myMessage = $_POST['sendMessage'];
    echo $myMessage;

    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $querySelect = "SELECT user_id FROM users WHERE Full_name = ?";
    $stmtSelect = $pdo->prepare($querySelect);
    $stmtSelect->execute(array($_SESSION['receiver']));
    $users = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
    if($stmtSelect->rowCount() > 0){
        foreach($users as $user){
            $query = "INSERT INTO chatbox(from_user,to_user,message,user_id) VALUES(?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array("BJLC",$_SESSION['receiver'],$myMessage,$user['user_id']));
            // $_SESSION['receiver_user_id'] = $user['user_id'];
        }

    }
}

?>