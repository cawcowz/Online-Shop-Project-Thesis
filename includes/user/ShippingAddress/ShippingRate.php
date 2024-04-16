<?php

$luzon = array(
    'ilocos norte','abra','albay','apayao','batanes','batangas','benguet','cagayan','camarines norte','camarines sur','catanduanes','cavite','ifugao','ilocos sur','isabela','kalinga','la union','laguna','marinduque','masbate','mountain province','nueva vizcaya','occidental mindoro','oriental mindoro','palawan','pangasinan','quezon','quirino','rizal','romblon','sorsogon');
$Central = array('aurora','bataan','bulacan','nueva ecija','pampanga','tarlac','zambales');
$visayas = array(
    'aklan','antique','biliran','bohol','capiz','cebu','eastern samar','guimaras','iloilo','leyte','negros occidental','negros oriental','northern samar','samar','siquijor','southern leyte');
$mindanao = array(
    'agusan del norte','agusan del sur','alabel','basilan','bukidnon','camiguin','compostela valley','davao del norte','davao del sur','davao occidental','davao oriental','dinagat islands','lanao del norte','lanao del sur','maguindanao','misamis occidental','misamis oriental','north cotabato','south cotabato','sultan kudarat','sulu','surigao del norte','surigao del sur','tawi-tawi','zamboanga del norte','zamboanga del sur','zamboanga sibugay');

$product = array();

if(isset($_POST['checkout'])){
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM user_cart WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($_SESSION['user_id']));
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($datas as $data){
        $quantity = $data['quantity'];
        // echo $quantity;
        $query = "SELECT weight FROM inventory_table WHERE product_name = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($data['product_name']));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            $product []= $data['quantity'] * $rows['weight'];
           
        }
    }
}

$totalWeight = (array_sum($product));


    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($_SESSION['user_id']));
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){

    foreach($datas as $data){
        if($data['major_place'] == "Central"){
            if($data['city'] == "paniqui"){
                if($totalWeight < 10){
                    echo  25;
                }else if($totalWeight > 10){
                    echo 60;
                }
            }else if($data['city'] =='moncada'|| $data['city'] == "gerona" || $data['city'] == 'anao' || $data['city']== "cuyapo" ||$data['city'] == "camiling" ||$data['city'] == "camilling"){
                $first_class = 85; //0.5 below
                $second_class = 115; // 0.5 - 1 
                $third_class = 155; //1 - 3 kg 
                $third_class = 225; //3kg - 4 kg 
                $fourth_class = 305; // 4kg - 5kg
                $fifth_class = 455; //5kg 
                if($totalWeight < 0.5){
                    echo  55;
                }else if($totalWeight < 1){
                    echo 85;
                }else if($totalWeight < 3){
                    echo 100;
                }else if($totalWeight < 4){
                    echo 125;
                }else if($totalWeight < 5){
                    echo 150;
                }else if($totalWeight > 5){
                    echo 150;
                }
            }else{
                $first_class = 85; //0.5 below
                $second_class = 115; // 0.5 - 1 
                $third_class = 155; //1 - 3 kg 
                $third_class = 225; //3kg - 4 kg 
                $fourth_class = 305; // 4kg - 5kg
                $fifth_class = 455; //5kg 
                if($totalWeight < 0.5){
                    echo  85;
                }else if($totalWeight < 1){
                    echo 115;
                }else if($totalWeight < 3){
                    echo 155;
                }else if($totalWeight < 4){
                    echo 225;
                }else if($totalWeight < 5){
                    echo 255;
                }else if($totalWeight > 5){
                    echo 300;
                }
            }
        }
        if($data['major_place'] == "Luzon"){
            $first_class = 95; //0.5 below
            $second_class = 165; // 0.5 - 1 
            $third_class = 190; //1 - 3 kg 
            $third_class = 285; //3kg - 4 kg 
            $fourth_class = 370; // 4kg - 5kg
            $fifth_class = 465; //5kg 
            if($totalWeight < 0.5){
                echo  95;
            }else if($totalWeight < 1){
                echo  165;
            }else if($totalWeight < 3){
                echo  190;
            }else if($totalWeight < 4){
                echo  285;
            }else if($totalWeight < 5){
                echo  465;
            }else if($totalWeight > 5){
                echo 500;
            }
        }
        if($data['major_place'] == "Visayas"){
            $first_class = 100; //0.5 below
            $second_class = 180; // 0.5 - 1 
            $third_class = 200; //1 - 3 kg 
            $third_class = 300; //3kg - 4 kg 
            $fourth_class = 400; // 4kg - 5kg
            $fifth_class = 500; //5kg 
            if($totalWeight < 0.5){
                echo  100;
            }else if($totalWeight < 1){
                echo  180;
            }else if($totalWeight < 3){
                echo  300;
            }else if($totalWeight < 4){
                echo  400;
            }else if($totalWeight < 5){
                echo  500;
            }else if($totalWeight > 5){
                echo 500;
            }
        }
        if($data['major_place'] == "Mindanao"){
            $first_class = 110; //0.5 below
            $second_class = 200; // 0.5 - 1 
            $third_class = 250; //1 - 3 kg 
            $third_class = 380; //3kg - 4 kg 
            $fourth_class = 400; // 4kg - 5kg
            $fifth_class = 500; //5kg 

            if($totalWeight < 0.5){
                echo  110;
            }else if($totalWeight < 1){
                echo  200;
            }else if($totalWeight < 3){
                echo  350;
            }else if($totalWeight < 4){
                echo  450;
            }else if($totalWeight < 5){
                echo  500;
            }else if($totalWeight > 5){
                echo 600;
            }
        }
    }
    
}else{
    echo 0;
}