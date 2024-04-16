<?php 

$pdo = new PDO ("mysql:host=localhost;dbname=inventory_system","root","");
$query = "DELETE FROM orders WHERE uniqid = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($_GET["uniqid"]));
header('location:../../Order.php');