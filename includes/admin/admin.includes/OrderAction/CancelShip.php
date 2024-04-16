<?php 

$uniqid = $_GET['uniqid'];
$action = "cancelled";
$pdo = new PDO('mysql:host=localhost;dbname=inventory_system', "root","");

// Add to records 
$querySelect = "SELECT * FROM ship WHERE uniqid = ?";
$stmtSelect = $pdo->prepare($querySelect);
$stmtSelect->execute(array($uniqid));
$show = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
foreach($show as $show){
    echo $uniqid;
    $queryInsertRecord = "INSERT INTO records (Full_name,address,product_name,order_id,quantity,total,img,user_id,status,uniqid,action) VALUES(?,?,?,?,?,?,?,?,?,?,?) ";
    $stmtInsert = $pdo->prepare($queryInsertRecord);
    $stmtInsert->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['quantity'],$show['total'],$show['img'],$show['user_id'],$show['status'],$show['uniqid'],$action));
};

// delete
$query = "DELETE FROM ship WHERE uniqid = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($uniqid));
header('location:../../Ship.php');