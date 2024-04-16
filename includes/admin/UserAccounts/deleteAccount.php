<?php
$id = $_GET['id'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
$query = "DELETE FROM users WHERE id = ? ";
$stmt = $pdo->prepare($query);
$stmt->execute(array($id));
header("location:../Settings.php");