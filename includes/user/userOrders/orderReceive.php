<?php

session_start();
include_once 'userOrdersController.php';
    $user_id =  $_SESSION['user_id'];
    $userOrdersController = new userOrdersController();
    $myOrders = $userOrdersController->outForDelivery($user_id);

    $outfordelivery = $myOrders->fetchAll(PDO::FETCH_ASSOC);
    foreach ($outfordelivery as $outfordelivery){
        $pn =  $outfordelivery['product_name'];
        $fn =  $outfordelivery['Full_name'];
        $address =  $outfordelivery['address'];
        $order_id =  $outfordelivery['order_id'];
        $quantity =  $outfordelivery['quantity'];
        $total =  $outfordelivery['total'];
        $img =  $outfordelivery['img'];
        $user_id =  $outfordelivery['user_id'];
        $status =  'torate';
        $uniqid =  $outfordelivery['uniqid'];
        
        $userOrdersController->Delivered($uniqid);
        $userOrdersController->OrderReceive($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$status,$uniqid);
        $userOrdersController->addHistory($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$status,$uniqid);
        $userOrdersController->insertToSales($fn,$address,$pn,$order_id,$total,$quantity);
        $userOrdersController->updateSold($pn,$quantity);
        $userOrdersController->deleteOrder($uniqid);
        header('location:ToRate.php');
    }
