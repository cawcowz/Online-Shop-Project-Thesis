<?php
session_start();
    $uniqid = $_GET['uniqid'];
    $pdo = new PDO('mysql:host=localhost;dbname=inventory_system',"root","");
    $query = "SELECT * FROM inventory_table WHERE uniqid = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($uniqid));
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $user_id = $_SESSION['user_id'];

    foreach($datas as $data){
        $query ="INSERT INTO wishlist(user_id,product_name,description,price,stocks,brand,discount,sold,image,uniqid) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($user_id,$data['product_name'],$data['description'],$data['price'],$data['stocks'],$data['brand'],$data['discount'],$data['sold'],$data['image'],$data['uniqid']));

    }
    header('location:../User.php?success=Added to your wishlist');
