<?php 
 $order_id = $_GET['order_id'];
 include_once '../productcontroller.php';
 $ProductController = new ProductController();

 $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
 $query = "SELECT * FROM toreceive WHERE order_id = ?";
 $stmt = $pdo->prepare($query);
 $stmt->execute(array($order_id));
 $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
 foreach($datas as $data){
    $product_name = $data['product_name'];
    $full_name = $data['Full_name'];
    $address =$data['address'];
    $order_id =$data['order_id'];
    $quantity = $data['quantity'];  
    $total =$data['total'];
    $img = $data['img'];
    $user_id = $data['user_id'];
    $action = "Delivered";
    $status = 'torate';
    $uniqid = uniqid();
    
    $query = "INSERT INTO records(Full_name,product_name,address,order_id,quantity,total,img,user_id,action) VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($full_name,$product_name,$address,$order_id,$quantity,$total,$img,$user_id,$action));

   //  Insert to torate
    $query = "INSERT INTO torate(Full_name,product_name,address,order_id,quantity,total,img,user_id,action,status,uniqid) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($full_name,$product_name,$address,$order_id,$quantity,$total,$img,$user_id,$action,$status,$uniqid));

   //  Insert to sales
   $query = "INSERT INTO sales(Full_name,product_name,address,order_id,quantity,total) VALUES(?,?,?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($full_name,$product_name,$address,$order_id,$quantity,$total));
    
   //  Update sold
   $ProductController->updateSold($quantity,$product_name);

   // Update stocks
      $query = "SELECT stocks FROM inventory_table WHERE product_name = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($product_name));
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            foreach($datas as $data){
               $newStocks = $data['stocks']-$quantity ;
               $query = "UPDATE inventory_table SET stocks = ? WHERE product_name = ?";
               $stmt = $pdo->prepare($query);
               $stmt->execute(array($newStocks,$product_name));
            }
        }
        // Insert to notification
        $query = "INSERT INTO notification(Fullname,address,order_id,product_name,quantity,total,img,user_id,status) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt =$pdo->prepare($query);
        $stmt->execute(array($full_name,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status));

     

      // delete items
      $query = "DELETE FROM toreceive WHERE order_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($order_id));
        header("location:../../receive.php");
 }