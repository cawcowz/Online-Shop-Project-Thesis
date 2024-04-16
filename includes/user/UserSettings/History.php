<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    include_once 'profileController.php';
    $profileController = new ProfileController;
    $datas = $profileController->displayHistory($user_id);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <title>Profile</title>
            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class='p-10 font-[poppins]'>
    <div class="container border bg-gray-100/20 shadow p-2 md:w-6/12 md:mx-auto">
        <div class=''>
            <a href="../User.setting.php"><i class="fa-solid fa-arrow-left"></i></a>
            <span class="pl-2 text-2xl font-semibold text-red-600">Profile</span>
            <div class="border-2 mt-4"></div>
        </div>
        <div class='mt-4 mb-2'>
            <h1 class='font-semibold text-lg'>History</h1>
        </div>
        <?php   foreach($datas as $data){ ?>
            <?php if($data['status']=="Delivered"){?>
 
                <div class='border border-sky-100 bg-sky-200/20 mb-1 '>
                    <h1 class='text-md text-blue-500'>Parcel Delivered</h1>
                    <span class='text-sm text-gray-400'>Order 
                        <span class='text-gray-500'>
                            <?php echo $data['product_name']?>
                        </span>
                        is completed.
                    </span>
                </div>

            <?php }else if($data['status'] == "Failed"){?>
                <div class='border-2 border-sky-100 bg-sky-200/20 mb-1'>
                    <h1 class='text-md text-red-400'>Delivery Failed</h1>
                    <span class='text-sm text-gray-400'>Parcel  
                        <span class='text-gray-500'>
                            <?php echo $data['product_name']?>
                        </span>
                        falied to deliver.
                    </span>
                </div>
            <?php }else{?>
                <div class='border border-sky-100 bg-sky-200/20 mb-1'>
                    <h1 class='text-md text-yellow-500'>Return Parcel</h1>
                    <span class='text-sm text-gray-400'>Parcel  
                        <span class='text-gray-500'>
                            <?php echo $data['product_name']?>
                        </span>
                        is has been returned.
                    </span>
                </div>
            <?php }?>
        <?php }?>
    </div>
</body>
</html>