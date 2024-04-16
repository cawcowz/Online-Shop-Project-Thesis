<?php
$order_id= $_GET['order_id'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
$query = "SELECT * FROM toreceive WHERE order_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($order_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0 ){
    foreach ($rows as $row) {
        
        $query = "INSERT INTO records(Full_name,product_name,address,order_id,quantity,total,img,user_id,action) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($row['Full_name'],$row['product_name'],$row['address'],$row['order_id'],$row['quantity'],$row['total'],$row['img'],$row['user_id'],"Failed"));
      
        // Delete
        $query = "DELETE FROM toreceive WHERE order_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($order_id));
        header("location:Receive.php");
    }
}