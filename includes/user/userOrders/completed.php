<?php
session_start();
$user_id =  $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed</title>
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class='font-[poppins] bg-gray-100'>
<div class='border shadow-md md:w-7/12 mx-auto mt-10 p-5 bg-white'>
        <div class=" p-2">
            <!-- Back -->
            <a href="../User.setting.php"><i class="fa-solid fa-arrow-left mb-5 hover:scale-105 duration-300 hover:text-red-500"></i></a>
            <!-- logo  -->
            <div>
                <a href='../user.php' class ='font-bold text-3xl '>BJLC |</a><span class='text-[#d0011b] text-md'>  Completed </span>
                <hr>
            </div>

            <?php
                $db = new PDO("mysql:host=localhost;dbname=inventory_system","root",'');
                $stmt = $db->prepare('SELECT * FROM records WHERE user_id = ?');
                $stmt->execute(array($_SESSION['user_id']));
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $order_id = [];
                $action = [];
                if($stmt->rowCount() > 0 ){?>
                    <?php foreach($rows as $row){?>
                        <?php if($row['action'] == "Delivered"){?>
                            <div class='border p-2 mt-1'>
                                <div class='flex items-center justify-between text-sm'>
                                    <div class='flex  items-center text-sm'>
                                        <img name='image' src="../../admin/admin.includes/uploads/<?php echo $row['img']; ?>" alt="" class='w-[50px] h-[50px] '>
                                        <h1><?php echo $row['product_name']?></h1>
                                    </div>
                                    <div class='flex'>
                                        <span class='ml-2'><?php echo "x" .$row['quantity']?></span>
                                        <span class='ml-2 text-red-600'><?php echo "P" .$row['total']?></span>
                                    </div>
                                </div>
                            </div>
                    <?php }}?>
                <?php }else{ ?>
                    <div class='flex justify-center items-center p-10 flex-col mt-10'>
                            <h1 class='text-6xl text-gray-500'><i class="fa-solid fa-clipboard-list"></i></h1>
                            <span class='mt-3 text-gray-700'>No orders Yet</span>
                        </div>
                <?php } ?>   

        </div>
    </div>
</body>
</html>