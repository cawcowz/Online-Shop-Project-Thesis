<?php
session_start();
$luzon = array(
    'ilocos norte','abra','albay','apayao','batanes','batangas','benguet','cagayan','camarines norte','camarines sur','catanduanes','cavite','ifugao','ilocos sur','isabela','kalinga','la union','laguna','marinduque','masbate','mountain province','nueva vizcaya','occidental mindoro','oriental mindoro','palawan','pangasinan','quezon','quirino','rizal','romblon','sorsogon');
$Central = array('aurora','bataan','bulacan','nueva ecija','pampanga','tarlac','zambales');
$visayas = array(
    'aklan','antique','biliran','bohol','capiz','cebu','eastern samar','guimaras','iloilo','leyte','negros occidental','negros oriental','northern samar','samar','siquijor','southern leyte');
$mindanao = array(
    'agusan del norte','agusan del sur','alabel','basilan','bukidnon','camiguin','compostela valley','davao del norte','davao del sur','davao occidental','davao oriental','dinagat islands','lanao del norte','lanao del sur','maguindanao','misamis occidental','misamis oriental','north cotabato','south cotabato','sultan kudarat','sulu','surigao del norte','surigao del sur','tawi-tawi','zamboanga del norte','zamboanga del sur','zamboanga sibugay');

// $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($_SESSION['user_id']));
$provinces = $stmt->fetch(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0){
    if(in_array($provinces['province'], $Central)){
        echo "Estimated day of delivery: 1-2 days";
    }
    if(in_array($provinces['province'], $luzon)){
        echo "Estimated day of delivery: 2-5 days";
    }
    if(in_array($provinces['province'], $visayas)){
        echo "Estimated day of delivery: 5-7 days";
    }
    if(in_array($provinces['province'], $mindanao)){
        echo "Estimated day of delivery: 5-7 days";
    }
  
}
?>

