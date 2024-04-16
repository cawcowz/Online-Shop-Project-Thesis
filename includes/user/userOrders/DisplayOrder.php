<?php
$order_id = $_GET['order_id'];

$pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root",'');
// select user_order first

$query = "SELECT * FROM user_order WHERE order_id = ? ";
$stmt = $pdo->prepare($query);
$stmt->execute(array($order_id));
if($stmt->rowCount() > 0){
    $query = "SELECT * FROM toreceive WHERE order_id = ? ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($order_id));
    $rows  = $stmt->fetchAll(PDO::FETCH_ASSOC);?>

     <script src="https://cdn.tailwindcss.com"></script>
             <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Design here -->
    <body class='bg-gray-100 '>
    <form action="" method='post' class=''>
        <div class= 'md:w-5/12 border mx-auto bg-white'>
            <!-- Back -->
            <a href="ToReceive.php"><i class="fa-solid  text-lg fa-arrow-left hover:scale-105 hover:text-red-500 duration-300 ml-2 mt-3  "></i></a>
            <h1 class='text-2xl font-bold ml-2'>Orders details</h1>

            <div class=' bg-teal-500 mt-2 p-2 '>
                <span class='text-white font-semibold text-lg'><?php include "EstimatedDate.php"?></span>
                <h1 class=' text-white'>Your Parcel has been delivered </h1>
                <span class=' text-white text-sm'>Please check your product(s) and file for Return/Refund if needed.</span>
            </div>
            <div class=''>
                <div class='flex flex-col border mt-3 border p-2'>
                    <?php foreach($rows as $row){ ?>
                        <div class='flex  justify-between  '>
                            <div class='flex   '>
                                <img name='image' src="../../admin/admin.includes/uploads/<?php echo $row['img']; ?>" alt="" class='w-[50px] h-[50px] '>
                                <h1 class='text-sm'><?php echo $row['product_name']?></h1>
                            </div>
                            <div class='text-end w-[20%] justify-end flex'>
                                <h1 class='ml-2 text-sm text-gray-600'><?php echo "x" .$row['quantity']?></h1>
                                <h1 class='ml-2 text-sm text-red-500'><?php echo "P" .$row['total']?></h1>
                            </div>
                        </div>
                       
                    <?php }?>
                </div >
                <!-- For shipping and total -->
                <?php 
                    $query = "SELECT * FROM user_order WHERE order_id = ?";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(array($order_id));
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($stmt->rowCount() > 0){?>
                        <div class='p-2 flex w-full justify-between' >
                            <h1 class='text-sm'>Shipping Fee </h1>
                            <h1 class='text-sm text-red-500'><?php echo "P".$data['shipping']?></h1>
                        </div>
                        <div class='p-2 flex justify-between'>
                            <h1>Order total </h1>
                            <h1 class='text-md text-red-500'><?php echo "P".$data['total']?></h1>
                        </div>
                        
                        <div class='p-2 mb-2'> 
                            <a href="Refund.php?order_id=<?php echo $order_id?>" class='p-2 border border-red-500 text-sm rounded-sm hover:bg-red-200 '>Refund</a>
                            <a href="OrderReceived.php?order_id=<?php echo $data['order_id'] ?>"class='p-2 bg-red-500 rounded-sm   text-sm hover:border-red-500 hover:border text-white'>Order Received</a>
                        </div>
                        <?php } ?>
                </div>
  
        </div>
    </form>
</body>
<?php } ?>
