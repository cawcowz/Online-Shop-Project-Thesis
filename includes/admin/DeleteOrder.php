<?php 
    include_once 'admin.includes/ProductController.php';

    $controller = new ProductController();
    $uid = $_GET['uid'];
    $deleteOrder = $controller->deleteOrder($uid);
    header("location: order.php?delete=success");
?>