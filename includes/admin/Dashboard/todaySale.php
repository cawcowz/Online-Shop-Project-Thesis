<?php
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
$query = "SELECT * FROM sales";
$stmt= $pdo->prepare($query);
$stmt->execute();
$sum = 0;
$dahsboardSale = 0; 
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($datas as $data){
        $dataTime = $data['time'];      
        list($date,$t)=explode(' ',$dataTime);
        list($y,$m,$d) = explode("-",$date);
        $todaySale = $y."-".$m."-".$d;
        if($todaySale == Date("Y-m-d") ){
            if($data['total'] != 0){
                $dahsboardSale = $sum +=$data['total'];
            }
            else{
                $dahsboardSale = 0;
            }
        }
    }
    echo $dahsboardSale;





