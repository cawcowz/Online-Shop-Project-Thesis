<?php 

if(isset($_POST['pwdR'])){
    $pwdR = $_POST['pwdR'];
    $pwd = $_POST['pwd'];
    $pwdTrim =str_replace(' ', ' ',$pwd); 
    $pwdRTrim =str_replace(' ', ' ',$pwdR); 
        if($pwdTrim != $pwdRTrim){
            echo "Password not match";
        }
}