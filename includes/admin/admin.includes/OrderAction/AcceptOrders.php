<?php
    include_once '../productcontroller.php';
    $ProductController = new ProductController();

// if(isset($_POST['acceptOrders'])){
//     $fn = $_POST['fullname'];
//     $address = $_POST['address'];
//     $order_id = $_POST['order_id'];
//     $product_name = $_POST['pn'];
//     $total = $_POST['total'];
//     $img = $_POST['img'];
//     $quantity = $_POST['quantity'];
//     $user_id = $_POST['user_id'];
//     $status = "toship";

   
    // echo $product_name;

    // $acceptOrder = $ProductController->acceptOders($fn,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status);
    // $acceptOrder = $ProductController->notify($fn,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status);
    // $acceptOrder = $ProductController->removeDataFromOrder($order_id);
    // header("location:../../order.php");

// }

$id =  $_GET['id'];
$pdo = new PDO("mysql:host=localhost;dbname=inventory_system", 'root','');
$query = "SELECT * FROM orders WHERE uniqid = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($id));
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($datas as $data){
    $name = $data['Full_name'];
    $address = $data['address'];
    $product_name = $data['product_name'];
    $price = $data['price'];
    $img = $data['img'];
    $quantity = $data['quantity'];
    $user_id = $data['user_id'];
    $order_id = $data['order_id'];
    $status = 'toship';
    $uniqid = $data['uniqid'];

    $acceptOrder = $ProductController->acceptOders($name,$address,$order_id,$product_name,$quantity,$price,$img,$user_id,$status,$uniqid);
    $ProductController->notify($name,$address,$order_id,$product_name,$quantity,$price,$img,$user_id,$status);
    $ProductController->remove($id);
    $ProductController->TrackingNum($uniqid);
    header("location:../../Order.php");
}