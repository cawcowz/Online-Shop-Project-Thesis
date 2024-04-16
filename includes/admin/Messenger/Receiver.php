<?php
session_start();

if(isset($_GET['receiver'])){
    $_SESSION['receiver'] = $_GET["receiver"];
    $_SESSION['img'] = $_GET["img"];
    header("location:../Messages.php");
    // echo $_GET['receiver'];
}