<?php
session_start();
$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root",'');
$query = "SELECT * FROM ship WHERE order_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($order_id));
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0){
    foreach($datas as $data){
        $query = "INSERT INTO records(Full_name,product_name,order_id,address,quantity,img,total,username,action,user_id) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($data['Full_name'],$data['product_name'],$order_id,$data['address'],$data['quantity'],$data['img'],$data['price'],$data['username'],"Cancelled",$user_id));

        // Delete
        $query = "DELETE FROM ship WHERE order_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($order_id));
        header('location:ToShip.php');
    }
}