<?php 
session_start();
include_once 'userOrdersController.php';
    $user_id =  $_SESSION['user_id'];
    $userOrdersController = new userOrdersController();
    $myOrders = $userOrdersController->rate($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Receive</title>
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
                <a href='../user.php' class ='font-bold text-3xl '>BJLC |</a><span class='text-[#d0011b] text-md'>  My Purchases</span>
                <hr>
            </div>

            <?php 
                  if($myOrders->rowCount() > 0){
                        $outfordelivery = $myOrders->fetchAll(PDO::FETCH_ASSOC);
                        foreach( $outfordelivery as $deliver){?>
                            <div class="mt-2">
                                <div class='p-2 border border-sky-500 bg-sky-100 '>
                                    <div class='flex justify-evenly'>
                                        <img name='image' src="../../admin/admin.includes/uploads/<?php echo $deliver['img']; ?>" alt="" class='w-[50px] h-[50px] '>
                                        <span class='w-7/12'><?php echo $deliver['product_name']?></span>
                                        <span class='mx-2'>x<?php echo $deliver['quantity']?></span>
                                        <span class='text-red-500 text-lg'>₱<?php echo $deliver['total']?>.00</span>
                                    </div>
                                    <form method='post'>
                                        <div class='flex justify-end mt-5 '>
                                            <a href='CommentSec.php?uniqid=<?php echo $deliver['uniqid']?>&fn=<?php echo $deliver['Full_name']?>' name = 'return'class='p-2  bg-yellow-500 hover:bg-yellow-500/30 duration-300  rounded-md mr-2'>Rate now</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- </div> -->
                        <?php }}else{?>
                                <div class='flex justify-center items-center p-10 flex-col mt-10'>
                                    <h1 class='text-6xl text-gray-500'><i class="fa-regular fa-star"></i></h1>
                                    <span class='mt-3 text-gray-700'>There is no product to rate now.</span>
                                </div>
            <?php }?>
        </div>
    </div>
</body>
</html>