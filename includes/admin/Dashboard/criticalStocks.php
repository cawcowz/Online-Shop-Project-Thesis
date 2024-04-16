<?php

$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
$query = "SELECT * FROM inventory_table";
$stmt= $pdo->prepare($query);
$stmt->execute();
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = 0;

foreach($datas as $data){
    if($data['stocks'] <= 10){
        $count++;
    }
}
echo $count;