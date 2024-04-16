<?php
include_once '../productcontroller.php';
$ProductController = new ProductController();

$uniqid = $_GET['uniqid'];
$action = "Delivered";
$pdo = new PDO('mysql:host=localhost;dbname=inventory_system', "root","");
$querySelect = "SELECT * FROM toreceive WHERE uniqid = ?";
$stmtSelect = $pdo->prepare($querySelect) ;
$stmtSelect->execute(array($uniqid));
$show  = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
foreach($show as $show){
    $query =  $queryInsertRecord = "INSERT INTO records (Full_name,address,product_name,order_id,quantity,total,img,user_id,status,uniqid,action) VALUES(?,?,?,?,?,?,?,?,?,?,?) ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['quantity'],$show['total'],$show['img'],$show['user_id'],$show['status'],$show['uniqid'],$action));
    
    $query =  $queryInsertRecord = "INSERT INTO torate (Full_name,address,product_name,order_id,quantity,total,img,user_id,status,uniqid,action) VALUES(?,?,?,?,?,?,?,?,?,?,?) ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['quantity'],$show['total'],$show['img'],$show['user_id'],$show['status'],$show['uniqid'],$action));

    $querySales = "INSERT INTO sales (Full_name,address,product_name,order_id,total,quantity) VALUES(?,?,?,?,?,?)";
    $stmtSales = $pdo->prepare($querySales);
    $stmtSales->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['total'],$show['quantity']));

    $ProductController->updateSold($show['quantity'],$show['product_name']);
    
}
// Delete
$queryDel = "DELETE FROM toreceive WHERE uniqid = ?";
$stmtDel = $pdo->prepare($queryDel);
$stmtDel->execute(array($uniqid));
header('location:../../Receive.php');