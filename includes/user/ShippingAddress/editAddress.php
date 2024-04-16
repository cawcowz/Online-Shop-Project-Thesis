<?php
session_start();

$luzon = array(
    'ilocos norte','abra','albay','apayao','batanes','batangas','benguet','cagayan','camarines norte','camarines sur','catanduanes','cavite','ifugao','ilocos sur','isabela','kalinga','la union','laguna','marinduque','masbate','mountain province','nueva vizcaya','occidental mindoro','oriental mindoro','palawan','pangasinan','quezon','quirino','rizal','romblon','sorsogon');
$Central = array('aurora','bataan','bulacan','nueva ecija','pampanga','tarlac','zambales');
$visayas = array(
    'aklan','antique','biliran','bohol','capiz','cebu','eastern samar','guimaras','iloilo','leyte','negros occidental','negros oriental','northern samar','samar','siquijor','southern leyte');
$mindanao = array(
    'agusan del norte','agusan del sur','alabel','basilan','bukidnon','camiguin','compostela valley','davao del norte','davao del sur','davao occidental','davao oriental','dinagat islands','lanao del norte','lanao del sur','maguindanao','misamis occidental','misamis oriental','north cotabato','south cotabato','sultan kudarat','sulu','surigao del norte','surigao del sur','tawi-tawi','zamboanga del norte','zamboanga del sur','zamboanga sibugay');

if(isset($_POST['fullname'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $Province = $_POST['province'];
    $province = strtolower($Province);
    $city = $_POST['city'];
    $city = strtolower($city);
    $brgy = $_POST['brgy'];
    $street  = $_POST['street'];


    if(in_array($province,$luzon)){
        $major_place = "Luzon";
    }else if(in_array($province,$Central)){
        $major_place = "Central";
    }else if(in_array($province,$visayas)){
        $major_place = "Visayas";
    }else if(in_array($province,$mindanao)){
        $major_place = "Mindanao";
    }
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $stmt = $pdo->prepare("UPDATE users SET Full_name = ? , email = ? , phone_no = ?, province = ? , city = ?, barangay = ?,  street = ?,address =? ,major_place = ? WHERE user_id = ?");           
    $stmt->execute(array($fullname,$email,$phone_no,$province,$city,$brgy,$street,$street." ".$brgy.",".$city.",".$province, $major_place,$_SESSION['user_id']));
    echo "Address has been updated!";
    
}