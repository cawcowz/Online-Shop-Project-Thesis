<?php
session_start();
$outputs = '';
$imageOutput = '';
$user_id = $_SESSION['user_id'];
$user = $_SESSION['fullname'];

$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
$query = "SELECT message , user_id,from_user ,to_user,date,img FROM chatbox WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute(array($user_id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0 ){
    $from_user = $row['from_user'];
    
    foreach($datas as $data){
        echo "<div class='flex flex-col w-full'>";
        if($data['from_user'] == "BJLC"){
            if($data['message'] != ''){
                $outputs .= "<div class='flex justify-start' >
                <div class='div flex flex-col items-start max-w-[80%]'>
                    <p class=' text-gray bg-gray-200 px-3 py-1 text-sm rounded-md mb-2'>$data[message]</p> 
                    <p class= 'text-[10px]'>$data[date]</p>
                </div>
                </div>";
            }else{
                $outputs .= "<div class='flex justify-start' >
                <div class='div flex flex-col items-start max-w-[80%]'>
                    <img src='ImageProof/$data[img]'>
                    <p class= 'text-[10px]'>$data[date]</p>
                </div>
                </div>";
            }
        }else {
            if($data['message'] != ''){
                $outputs .= "<div class='flex justify-end'>
                <div class='div flex flex-col items-end max-w-[80%]'>
                    <p class=' text-gray bg-blue-300 px-3 py-1 text-sm rounded-md mb-2'>$data[message]</p> 
                    <p class= 'text-[10px]'>$data[date]</p>
                </div>
                </div>";
            }else{
                $outputs .= 
                "<div class='w-full  flex justify-end'>
                <div class='div flex flex-col items-end max-w-[80%]'>
                    <img src='ImageProof/$data[img]' width='200'>
                    <p class= 'text-[10px]'>$data[date]</p>
                </div> 
                </div>";
            }
        }
        "<div>";?>
        
    <?php }
}

echo $outputs;

