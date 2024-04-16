<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BJLC Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- font awesome cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class='md:w-5/12 border mx-auto p-3 mt-10'>
        <a href="../user.setting.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class='font-bold text-4xl'>Tracking </h1>
        <div class='border mb-10 mt-2'></div>
        <?php
            $tracking_no = $_GET['no'];
            // echo $tracking_no;
            $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
            $query = "SELECT * FROM tracking WHERE track_no = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($tracking_no));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);?>
            <h1 class='text-gray-800 text-md text-green-500'> <i class="fa-solid fa-check text-sm"></i> Order Placed</h1>
             <h1 class='text-gray-800 text-md  text-green-500'> <i class="fa-solid fa-check text-sm"></i>Preparing to ship </h1>
             <span class='text-gray-500 text-sm  text-green-500'>Preparing to ship your parcel.</span>
            <?php if($stmt->rowCount() > 0){ ?>
                <?php if($data['status'] == "toship"){?>
                    <h1 class='text-gray-800 text-md  text-green-500'> <i class="fa-solid fa-check text-sm "></i> Your order has been packed. Please prepare for the Payment </h1>
                <?php }
                if($data['status'] == "toreceive"){?>
                    <h1 class='text-gray-800 text-md  text-green-500'> <i class="fa-solid fa-check text-sm "></i> Your order has been shipped. Please prepare for the Payment </h1>
                    <h1 class='text-blue-800 text-md  '>Out for Delivery</h1>
                <?php } }?>
    </div>
</body>
</html>