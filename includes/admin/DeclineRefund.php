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
        $stmt->execute(array($data['Full_name'],$data['product_name'],$data['order_id'],$data['address'],$data['quantity'],$data['img'],$data['total'],$data['username'],"Delivered",$data['user_id']));

        $query = "INSERT INTO torate(Full_name,product_name,order_id,address,quantity,img,total,username,action,user_id,status) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($data['Full_name'],$data['product_name'],$data['order_id'],$data['address'],$data['quantity'],$data['img'],$data['total'],$data['username'],"Delivered",$data['user_id'],"torate"));

        // /  Insert to sales
        $query = "INSERT INTO sales(Full_name,product_name,address,order_id,quantity,total) VALUES(?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($data['Full_name'],$data['product_name'],$data['address'],$data['order_id'],$data['quantity'],$data['total']));
        
 
       //Update sold 
       $query = "SELECT sold FROM inventory_table WHERE product_name = ?";
       $stmt = $pdo->prepare($query);
       $stmt->execute(array($data['product_name']));
       $solds = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           $sold =  $solds['sold'] +  $data['quantity'];
           $query = "UPDATE inventory_table SET sold = ? WHERE product_name = ?";
           $stmt = $pdo->prepare($query);
           $stmt->execute(array($sold,$data['product_name']));
       }

        // Update stocks
            $query = "SELECT stocks FROM inventory_table WHERE product_name = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($data['product_name']));
            $stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
                foreach($stocks as $stock){
                    $newStocks = $stock['stocks']-$data['quantity'] ;
                    $query = "UPDATE inventory_table SET stocks = ? WHERE product_name = ?";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(array($newStocks,$data['product_name']));
                }
            }
            // Insert to notification
            $query = "INSERT INTO notification(Fullname,address,order_id,product_name,quantity,total,img,user_id,status) VALUES(?,?,?,?,?,?,?,?,?)";
            $stmt =$pdo->prepare($query);
            $stmt->execute(array($data['Full_name'],$data['address'],$data['order_id'],$data['product_name'],$data['quantity'],$data['total'],$data['img'],$data['user_id'],"torate"));

        // /Delete
        $query = "DELETE FROM refund WHERE uniqid = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($uniqid));
        header('location:Refund.php');
    }
}