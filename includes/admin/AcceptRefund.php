<?php
$uniqid = $_GET['uniqid'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root",'');
$query = "SELECT * FROM refund WHERE uniqid = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($uniqid));
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0){
    foreach($datas as $data){
        $query = "INSERT INTO records(Full_name,product_name,order_id,address,quantity,img,total,username,action,user_id) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($data['Full_name'],$data['product_name'],$data['order_id'],$data['address'],$data['quantity'],$data['img'],$data['total'],$data['username'],"Refund",$data['user_id']));

        
        // /Delete
        $query = "DELETE FROM refund WHERE uniqid = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($uniqid));
        header('location:Refund.php');
    }
}