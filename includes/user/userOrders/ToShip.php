
<?php 
session_start();
include_once 'userOrdersController.php';
    $user_id =  $_SESSION['user_id'];
    $userOrdersController = new userOrdersController();
    $myOrders = $userOrdersController->myOrder($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToShip</title>
            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class='font-[poppins]'>
    <div class='border shadow-md md:w-7/12 mx-auto mt-10 p-5'>
        <div class=" p-2">
            <!-- Back -->
            <a href="../User.setting.php"><i class="fa-solid fa-arrow-left mb-5 hover:scale-105 duration-300 hover:text-red-500"></i></a>
            <!-- logo  -->
            <div>
                <a href='../user.php' class ='font-bold text-3xl '>BJLC |</a><span class='text-[#d0011b] text-md'>  To Ship </span>
                <hr>
            </div>

            <?php
                $db = new PDO("mysql:host=localhost;dbname=inventory_system","root",'');
                $stmt = $db->prepare('SELECT * FROM ship WHERE user_id = ?');
                $stmt->execute(array($_SESSION['user_id']));
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $order_id = [];
                if($stmt->rowCount() > 0 ){?>
                    <div class="mt-2">
                        <?php foreach($rows as $myOrder){ 
                            $order_id []= $myOrder['order_id'];   
                        }?>
                   
                                <?php // get order id
                                    $query = "SELECT * FROM user_order WHERE order_id = ?";
                                    $stmt= $db->prepare($query);
                                    $stmt->execute(array($myOrder['order_id']));
                                    $datas = $stmt->fetch(PDO::FETCH_ASSOC);
                                    if($stmt->rowCount() > 0){?>
                                    <!-- For order_id -->
                                        <?php $order_id []= $datas['order_id']?>
                                    <?php }?>
                                    <?php  $array_order = array_unique($order_id);?>
                                    <?php foreach($array_order as $arr){?>
                                        <div class='p-2 border  bg-sky-100/50 mt-1'>
                                        <!-- For items -->
                                        <?php
                                            $query ="SELECT * FROM ship WHERE order_id = ?";
                                            $stmt = $db->prepare($query);
                                            $stmt->execute(array($arr));
                                            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                                            if($stmt->rowCount()>0){?>
                                                <div class='flex justify-evenly'>
                                                    <img name='image' src="../../admin/admin.includes/uploads/<?php echo $rows['img']; ?>" alt="" class='w-[50px] h-[50px] '>
                                                    <span class='w-7/12 text-sm'><?php echo $rows['product_name']?></span>
                                                    <span class='mx-2 text-sm'>x<?php echo $rows['quantity']?></span>
                                                </div>
                                           <?php }?>
                                                
                                         <!-- For TOtal -->
                                         <?php
                                            $query ="SELECT * FROM user_order WHERE order_id = ?";
                                            $stmt = $db->prepare($query);
                                            $stmt->execute(array($arr));
                                            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                                            if($stmt->rowCount() > 0){?>
                                                <div class='w-full text-end'>
                                                    <span class='text-sm'>Total: </span>
                                                    <span class='text-red-500 text-sm'>₱<?php echo $rows['total']?>.00</span>
                                                </div>
                                           <?php } ?>
                                            <!-- For tracking -->
                                            <?php 
                                            $query ="SELECT * FROM tracking WHERE order_id = ?";
                                            $stmt = $db->prepare($query);
                                            $stmt->execute(array($arr));
                                            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                                            if($stmt->rowCount() > 0){?>
                                                <div class='flex text-sm justify-between mt-2 mb-2'  >
                                                    <div class='flex'>
                                                        <h1 class='text-sm'>Tracking no:</h1>
                                                        <a href="track.php?no=<?php echo $rows['track_no']?>" class='underline ml-2 text-[13px]'><?php echo $rows['track_no'];?></a>
                                                        <span class='text-teal-500 ml-2'><i class="text-sm fa-solid fa-box-open"></i>Parcel is now ready to ship</span>
                                                    </div>
                                                    <div class=''>
                                                        <a href="CancelOrder.php?order_id=<?php echo $rows['order_id']?>" class='bg-red-800 p-1 rounded-sm text-sm text-white hover:bg-red-700'>Cancel Order</a>
                                                    </div>
                                                </div>
                                                <div class='w-full text-end mt-1    '>
                                                    <a href="DisplayToShip.php?order_id=<?php echo $rows['order_id']?>" class='text-blue-500'>see all</a>
                                                    
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php }?>
                    </div>
                    
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