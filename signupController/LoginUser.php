<?php

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * from users WHERE user_name = ? or email = ? AND pwd = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($username,$username,$password));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        if($rows['is_admin']){
            $_SESSION['user'] = $rows['user_name'];
            $_SESSION['is_admin'] = $rows['is_admin'];
            $_SESSION['address'] = $rows['address'];
            echo "Admin";
            // header("location:includes/admin/admin.php?$row[user_name]");
        }
    }
}