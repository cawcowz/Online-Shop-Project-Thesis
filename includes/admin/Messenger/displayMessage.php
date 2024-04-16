
<?php
session_start();
$outputs = '';


$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
$querySelect = "SELECT user_id FROM users WHERE Full_name = ?";
$stmtSelect = $pdo->prepare($querySelect);
$stmtSelect->execute(array($_SESSION['receiver']));
$users = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
if($stmtSelect->rowCount() > 0){
    foreach($users as $user){
        $query = "SELECT message , user_id,from_user ,to_user,date,img FROM chatbox WHERE user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($user['user_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0 ){
            $from_user = $row['from_user'];
        }
        
        foreach($datas as $data){
            echo "<div class='flex flex-col w-full'>";
            if($data['from_user'] == "BJLC"){
                if($data['message'] != ''){
                    $outputs .= "<div class='flex justify-end' >
                    <div class='div flex flex-col items-start max-w-[80%]'>
                        <p class=' text-gray bg-blue-300 px-3 py-1 text-sm rounded-md mb-2'>$data[message]</p> 
                        <p class= 'text-[10px]'>$data[date]</p>
                    </div>
                    </div>";
                }else{
                    $outputs .= "<div class='flex justify-start' >
                    <div class='div flex flex-col items-start max-w-[80%]'>
                        <img src='../User/ImageProof/$data[img]'>
                        <p class= 'text-[10px]'>$data[date]</p>
                    </div>
                    </div>";
                }
            }else {
                if($data['message'] != ''){
                    $outputs .= "<div class='flex justify-start'>
                    <div class='div flex flex-col items-end max-w-[80%]'>
                        <p class=' text-gray  bg-gray-200 px-3 py-1 text-sm rounded-md mb-2'>$data[message]</p> 
                        <p class= 'text-[10px]'>$data[date]</p>
                    </div>
                    </div>";
                }else{
                    $outputs .= "<div class='flex justify-start'>
                    <div class='div flex flex-col items-end max-w-[80%]'>
                        <img src='../user/ImageProof/$data[img]'>
                        <p class= 'text-[10px]'>$data[date]</p>
                    </div>
                    </div>";
                }
            }
            "<div>";
        
        }
    }

}

echo $outputs;