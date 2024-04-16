<?php
if(isset($_POST['shippingTotal'])){
    $shippingTotal = $_POST['shippingTotal'];
    $product_total = $_POST['product_total'];
    echo $shippingTotal + $product_total;
}