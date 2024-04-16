<?php
session_start();
$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root",'');
$query = "SELECT * FROM toreceive WHERE order_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($order_id));
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($datas as $data){
        $query = "INSERT INTO refund(Full_name,product_name,order_id,address,quantity,img,total,username,action,user_id,uniqid) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($data['Full_name'],$data['product_name'],$order_id,$data['address'],$data['quantity'],$data['img'],$data['total'],$data['username'],"Refund",$user_id,uniqid()));

        // Delete
        $query = "DELETE FROM toreceive WHERE order_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($order_id));
        header('location:ToReceive.php');
    }
?>

    