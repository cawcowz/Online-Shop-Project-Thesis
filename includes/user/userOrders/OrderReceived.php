<?php
$order_id = $_GET['order_id'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root",'');
$query = "SELECT * FROM toreceive WHERE order_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($order_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$action = "Delivered";
if($stmt->rowCount() > 0){
    foreach($rows as $show){
        $query =  $queryInsertRecord = "INSERT INTO records (Full_name,address,product_name,order_id,quantity,total,img,user_id,status,uniqid,action) VALUES(?,?,?,?,?,?,?,?,?,?,?) ";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['quantity'],$show['total'],$show['img'],$show['user_id'],$show['status'],$show['uniqid'],$action));
        
        $query =  $queryInsertRecord = "INSERT INTO torate (Full_name,address,product_name,order_id,quantity,total,img,user_id,status,uniqid,action) VALUES(?,?,?,?,?,?,?,?,?,?,?) ";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['quantity'],$show['total'],$show['img'],$show['user_id'],$show['status'],$show['uniqid'],$action));
    
        $querySales = "INSERT INTO sales (Full_name,address,product_name,order_id,total,quantity) VALUES(?,?,?,?,?,?)";
        $stmtSales = $pdo->prepare($querySales);
        $stmtSales->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['total'],$show['quantity']));

        //Update sold 
            $query = "SELECT sold FROM inventory_table WHERE product_name = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($show['product_name']));
            $datas = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
                $sold =  $datas['sold'] +  $show['quantity'];
                $query = "UPDATE inventory_table SET sold = ? WHERE product_name = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array($sold,$show['product_name']));
            }
        // Update stocks
 
            $query = "SELECT stocks FROM inventory_table WHERE product_name = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($show['product_name']));
            $datas = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
                $newStock =  $datas['stocks'] - $show['quantity'];
                $query = "UPDATE inventory_table SET stocks = ? WHERE product_name = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array($newStock,$show['product_name']));
            }
            
            // Delete
            // Delete
            $queryDel = "DELETE FROM toreceive WHERE order_id = ?";
            $stmtDel = $pdo->prepare($queryDel);
            $stmtDel->execute(array($show['order_id']));
            header('location:ToReceive.php');

    }
}