<?php
if(isset($_POST['pwd'])){
    $pwd = $_POST['pwd'];
    $pwdTrim =str_replace(' ', ' ',$pwd); 
    if(strlen($pwdTrim) < 8 ){
        echo 'Password must have 8 or more character';
    }
}