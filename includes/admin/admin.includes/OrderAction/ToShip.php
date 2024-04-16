<?php
    include_once '../productcontroller.php';
    $ProductController = new ProductController();

    session_start();
$id =  $_GET['id'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system", 'root','');
$query = "SELECT * FROM ship WHERE uniqid = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($id));
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($datas as $data){
    $name = $data['Full_name'];
    $address = $data['address'];
    $product_name = $data['product_name'];
    $total = $data['total'];
    $img = $data['img'];
    $quantity = $data['quantity'];
    $user_id = $data['user_id'];
    $order_id = $data['order_id'];
    $status = 'toreceive';
    $uniqid = $data['uniqid'];
    $_SESSION['quantity'] = $quantity; 
    
    $queryInsert = "INSERT INTO toreceive (Full_name,address,product_name,total,img,quantity,user_id,order_id,status,uniqid) VALUES (?,?,?,?,?,?,?,?,?,? )";
    $stmtInsert = $pdo->prepare($queryInsert);
    $stmtInsert->execute(array($name,$address,$product_name,$total,$img,$quantity,$user_id,$order_id,$status,$uniqid));
   
    $ProductController->updateStock($quantity,$product_name);
    
    $ProductController->notify($name,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status);
    $ProductController->removeDataFromShip( $uniqid);
    $ProductController->UpdateTrack( $uniqid);
    header('location:../../Ship.php');
}
