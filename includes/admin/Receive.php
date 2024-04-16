<?php
    // include_once 'adminDb.php';
    // $db = new Db();
    // $query = "SELECT * FROM inventory_table ";
    // $stmt = $db->connect()->prepare($query);
    // $stmt->execute();
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    require_once 'admin.includes/ProductController.php';
        $db = new ProductController();
        $orders = $db->showToReceive();
         $count = 1;
    
?>

<title>Ship</title>
<?php include_once 'Header.php';?>

 <!-- Dashboard -->
 <div class="main--content">
    <!-- form -->
    <!-- <form action="admin.includes/orderaction/toreceive.php" method="post"  > -->
    <form action="" method="post"  >
        <div class="header--wrapper">
            <div class="header--title">
                <!-- <span>Primary</span> -->
                <h2 class="text-4xl">To Receive</h2>
            </div>
  

                   <!-- table -->
                   <div class="tabular--wrapper border  border-sky-500 w-full">
                                
                            <div class="table-container overflow-y-scroll h-[470px]">
                                <table class="">
                                    <thead class="bg-gray-900">
                                            <tr>
                                                <th>No.</th>
                                                <th>Date</th>
                                                <th>Fullname</th>
                                                <th>address</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Image</th>
                                                <th>Details</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $count = 1;
                                            // Variable to keep track of displayed values
                                        $displayedValues = array();
                                        foreach( $orders as $order){ ?>
                                        <tr>
                                                <?php if(!in_array($order['order_id'],$displayedValues)){?>
                                                <td><?php echo $count++?></td>
                                                <td><?php echo $order['time']?></td>
                                                <td class='flex items-center'>
                                                    <?php echo $order['Full_name']?>
                                                </td>
                                                <td><?php echo $order['product_name']?></td>
                                                <td><?php echo $order['address']?></td>
                                                <td><?php echo $order['order_id']?></td>
                                                <td> <img src="admin.includes/uploads/<?php echo $order['img']; ?>" width="60"alt=""></td>
                                                <td>
                                                    <a class='text-sky-400 underline' href="ViewReceive.php?uid=<?php echo $order['username']?>&oid=<?php echo $order['order_id']?>">view all</a>
                                                </td>
                                      
                                                <!-- <td class='flex gap-3'>
                                                    <a href="deleteorder.php?uid=<?php echo $order['username']?>" class='text-red-300'><i class="fa-solid fa-trash"></i></a>
                                                </td> -->
                                                <?php  $displayedValues[] = $order['order_id'];?>
                                        </tr>
                                            <?php }}?>
                                         </tbody>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                                 <!-- table end -->
        </form>
        <!-- Form end -->
    </div>

   


   
 