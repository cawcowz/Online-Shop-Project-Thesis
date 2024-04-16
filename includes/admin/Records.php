<?php
    // include_once 'adminDb.php';
    // $db = new Db();
    // $query = "SELECT * FROM inventory_table ";
    // $stmt = $db->connect()->prepare($query);
    // $stmt->execute();
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    require_once 'admin.includes/ProductController.php';
        $db = new ProductController();
        $rows = $db->DisplayRecords(); ?>
        <?php $count = 1;
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
                <h2 class="text-4xl">Records</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>

                    <input type="text" name="searchInput" class="text-gray-900" id="search" >

                    <input type="submit"  class="text-gray-900 " name="search" value="search">
                </div>
                <img src="admin.img/admin.jpg" alt="">
            </div>
        </div>  
        <!-- Search Start -->

                   <!-- table -->
                   <div class="tabular--wrapper border  border-sky-500">
                                <span class="main--title text-lg">Refresh</span>
                                <button class="rounded text-xl p-2" name="refresh" type="submit"><i class="fa-solid fa-arrows-rotate"></i></button>
                                <!-- Start Buttons filter -->
                                <div class='flex'>
                                    <button type='submit' name='success'class='bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm mb-2 hover:scale-105 duration-300'>success</button>
                                    <button type='submit' name = 'failed'class='bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm shadow-lg ml-2 mb-2 hover:scale-105 duration-300'>failed</button>

                                </div>
                                
                                <!-- end button -->
                            <div class="table-container overflow-y-scroll h-[470px]">
                                <table class="">
                                    <thead class="bg-gray-900">
                                            <tr>
                                                <th>No.</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Address</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                <?php if(isset($_POST['search'])){
                    require_once 'admin.includes/AdminDb.php';
                    $searchInput = $_POST['searchInput'];
                    $db = new Db();
                    $query = "SELECT * FROM records WHERE  product_name=? OR Full_name = ? ";
                    $stmt = $db->connect()->prepare($query);
                    $stmt->execute(array($searchInput,$searchInput));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if($stmt->rowCount() > 0){?>
              
                                        <?php $count = 1;?>
                                        <?php do{?>
                                            <tr>
                                                <td><?php echo $count++;?></td>
                                                <td><?php echo $row['time']; ?></td>
                                                <td><?php echo $row['Full_name']; ?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['total']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><img src="admin.includes/uploads/<?php echo $row['img']; ?>" width="60"alt=""></td>
                                                <td><?php echo $row['action']?></td>
                                            </tr>
                                            <?php }while($row = $stmt->fetch(PDO::FETCH_ASSOC))?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <!-- table end -->
                    <?php }
                }
                // <!-- Refresh data -->
   
                     else if(isset($_POST['refresh'])){?>
                                             <?php foreach ($rows as $row) {?>
                                                 <tr>
                                                 <td><?php echo $count++;?></td>
                                                <td><?php echo $row['time']; ?></td>
                                                <td><?php echo $row['Full_name']; ?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['total']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><img src="admin.includes/uploads/<?php echo $row['img']; ?>" width="60"alt=""></td>
                                                <td><?php echo $row['action']?></td>
                                                 </tr>
                                              <?php }?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                                 <!-- table end -->
     
                     <?php }else if(isset($_POST['success'])){?>
                        <?php foreach($rows as $row){?>
                            <?php if($row['action']== "Delivered"){?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $row['time'];?></td>
                                <td><?php echo $row['Full_name']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><img src="admin.includes/uploads/<?php echo $row['img']; ?>" width="60"alt=""></td>
                                <td><?php echo $row['action']?></td>
                            </tr>
                            <?php }?>
                        <?php }?>
                      <?php }else if(isset($_POST['failed'])){ ?>
                        <?php foreach($rows as $row){?>
                            <?php if($row['action']== "Failed"){?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $row['time'];?></td>
                                <td><?php echo $row['Full_name']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><img src="admin.includes/uploads/<?php echo $row['img']; ?>" width="60"alt=""></td>
                                <td><?php echo $row['action']?></td>
                            </tr>
                            <?php }?>
                        <?php }?>
                      <?php }else{ ?> 
                         <?php foreach ($rows as $row) {?>
                                                 <tr>
                                                 <td><?php echo $count++;?></td>
                                                <td><?php echo $row['time']; ?></td>
                                                <td><?php echo $row['Full_name']; ?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['total']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><img src="admin.includes/uploads/<?php echo $row['img']; ?>" width="60"alt=""></td>
                                                <td><?php echo $row['action']?></td>
                                                 </tr>
                                              <?php }?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                                 <!-- table end -->
                    <?php }
                ?>
                <!-- Refresh End -->                
           <!-- Search ENd -->

           
        </form>
        <!-- Form end -->
    </div>

   


   
 