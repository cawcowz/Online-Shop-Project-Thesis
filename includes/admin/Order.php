<?php
    // include_once 'adminDb.php';
    // $db = new Db();
    // $query = "SELECT * FROM inventory_table ";
    // $stmt = $db->connect()->prepare($query);
    // $stmt->execute();
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    session_start();
    require_once 'admin.includes/ProductController.php';
    
    $orders = new ProductController();
    $newOrders = $orders->orders();

?>

<title>Products</title>
<?php include_once 'Header.php';?>

 <!-- Dashboard -->
 <div class="main--content">
    <!-- form -->
    <form action="" method="post"  >
        <div class="header--wrapper">
            <div class="header--title">
                <!-- <span>Primary</span> -->
                <h2 class="text-4xl">Orders</h2>
            </div>

        </div>  
        <!-- Search Start -->

                   <!-- table -->
                   <div class="tabular--wrapper border  border-sky-500">
                            
                                <span class="main--title text-lg">Pending orders</span><button class="rounded text-xl p-2" name="refresh" type="submit"><i class="fa-solid fa-arrows-rotate"></i></button>
                              
                            <div class="table-container overflow-y-scroll h-[470px]">
                                <table class="">
                                    <thead class="bg-gray-900">
                                            <tr>
                                                <th>No.</th>
                                                <th>Date</th>
                                                <th>Username</th>
                                                <th>products</th>
                                                <th>Address</th>
                                                <th>Order Id</th>
                                                <th>Details</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $count = 1;
                                            // Variable to keep track of displayed values
                                        $displayedValues = array();
                                        foreach( $newOrders as $newOrder){ ?>
                                        <tr>
                                                <?php if(!in_array($newOrder['order_id'],$displayedValues)){?>
                                                <td><?php echo $count++?></td>
                                                <td><?php echo $newOrder['date']?></td>
                                                <td class='flex items-center'>
                                                    <?php echo $newOrder['username']?>
                                                    <img src="admin.includes/uploads/<?php echo $newOrder['img']; ?>" width="60"alt="">
                                                </td>
                                                <td><?php echo $newOrder['product_name']?></td>
                                                <td><?php echo $newOrder['address']?></td>
                                                <td><?php echo $newOrder['order_id']?></td>
                                                <td>
                                                    <a class='text-sky-400 underline' href="ViewOrder.php?uid=<?php echo $newOrder['username']?>&oid=<?php echo $newOrder['order_id']?>">view all</a>
                                                </td>
                                                <!-- <td class='flex gap-3'>
                                                    <a href="deleteorder.php?uid=<?php echo $newOrder['username']?>" class='text-red-300'><i class="fa-solid fa-trash"></i></a>
                                                </td> -->
                                                <?php  $displayedValues[] = $newOrder['order_id'];?>
                                        </tr>
                                            <?php }}?>
                                    </tbody>
                         </table>
        
           
        </form>
        <!-- Form end -->
    </div>

   
<?php 

$db = new PDO("mysql:host=localhost;dbname=inventory_system","root", "");
$query = "SELECT order_id FROM orders ";
$stmt = $db->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($data as $data){
     $_SESSION['order_id'] = $data['order_id'];
}
   


 