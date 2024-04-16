<?php
session_start();
    $orderCount = 0;
    $orderCounts = 1;
    $shipCount = 0;
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM orders";
    $stmt= $pdo->prepare($query);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        $orderCounts++;
        $_SESSION['orderCount'] = $orderCounts;
    }else{
        $orderCount;
    }
    $queryShip = "SELECT * FROM ship";
    $stmtship= $pdo->prepare($query);
    $stmtship->execute();
    $dataship = $stmtship->fetchAll(PDO::FETCH_ASSOC);

?>

<title>Products</title>
<?php include_once 'Header.php';?>

<!-- Dashboard -->
<div class="main--content">
    <!-- form -->
    <form action="" method="post"  >
        <div class="bg-white px-1 py-4 rounded-lg flex justify-evenly items-center ">
            <!-- <div class="header--title"></div> -->
            <div id="orders" class="w-[200px] bg-red-200/30 text-center px-8 py-6 shadow-md hover:scale-105 duration-300  cursor-pointer">
                <p class="text-lg text-blue-500"><?php if($_SESSION['orderCount'] > 0){echo $_SESSION['orderCount'];}else{echo $orderCount ; }?></p>
                <h1 class="text-sm">Orders</h1>
            </div>
            <div class="w-[200px] bg-red-200/30 text-center px-8 py-6 shadow-md hover:scale-105 duration-300 cursor-pointer">
                <p class="text-lg text-blue-500">0</p>
                <h1 class="text-sm">To Ship</h1>
            </div>
            <div class="w-[200px] bg-red-200/30 text-center px-8 py-6 shadow-md hover:scale-105 duration-300 cursor-pointer">
                <p class="text-lg text-blue-500">0</p>
                <h1 class="text-sm">To Deliver</h1>
            </div>
            <div class="w-[200px] bg-red-200/30 text-center px-8 py-6 shadow-md hover:scale-105 duration-300 cursor-pointer">
                <p class="text-lg text-blue-500">0</p>
                <h1 class="text-sm">Return/Refund</h1>
            </div>

        </div>  
        <!-- Search Start -->
                   <!-- table -->
                   <div class="tabular--wrapper border  border-sky-500 m-2 p-2">
                            <div class="table-container overflow-y-scroll h-[470px]">
                                <table class="" id="orders">
                                    <thead class="bg-gray-900">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
           
        </form>
        <!-- Form end -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $
        })
    </script>