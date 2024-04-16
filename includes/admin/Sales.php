<?php 
session_start();
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM sales ORDER BY id desc";
    $stmt= $pdo->prepare($query);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<title>Sales</title>
<?php include_once 'Header.php';?>

 <!-- Dashboard -->
 <div class="main--content">
    <!-- form -->
    <form action="" method="post"  >
        <div class="header--wrapper">
            <div class="header--title">
                <!-- <span>Primary</span> -->
                <h2 class="text-4xl">Sales</h2>
            </div>
            <a href='' class="user--info">
                <img src="admin.img/admin.jpg" alt="">
                <h1 class='text-sm bg-gray-100 p-2 rounded-xl'><?php echo $_SESSION['user_admin']?></h1>
            </a>
        </div>  
        <!-- Search Start -->

                   <!-- table -->
                   <div class="tabular--wrapper border  border-sky-500">
                        <!-- Filter -->
                        <div class="flex justify-end mb-10">
                            <div class="">
                                <span>From</span>
                                <input type="date" name="start_date" required class='bg-gray-200 px-5 py-2 shadow-md hover:bg-gray-300 rounded-md'>
                            </div>
                            <div class="">
                                <span >To</span>
                                <input type="date" name="end_date" required class='bg-gray-200 px-5 py-2 shadow-md hover:bg-gray-300 rounded-md'>
                            </div>
                            <!-- Button -->
                            <div class="">
                                <input type="submit" name="submit_date" value='submit' class='px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800'>
                            </div>
                        </div>
                        <!-- End Filter -->
                            <div class="table-container overflow-y-scroll h-[470px]">
                                <table class="">
                                    <thead class="bg-gray-900">
                                            <tr>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>total</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($_POST['submit_date'])){?>
                                            <?php
                                                $sum = 0;
                                                $start_date = $_POST['start_date'];
                                                $end_date = $_POST['end_date']; 
                                                $queryFilter = "SELECT * FROM sales WHERE time between ? and ? ORDER BY id DESC";
                                                $stmtFilter = $pdo->prepare($queryFilter);
                                                $stmtFilter->execute(array($start_date,$end_date));
                                                $filters = $stmtFilter->fetchAll(PDO::FETCH_ASSOC);
                                                foreach($filters as $filter){?>
                                                    <tr class='border-b border-2'>
                                                        <td><?php echo $filter['time'];?></td>
                                                        <td><?php echo $filter['product_name']?></td>
                                                        <td><?php echo $filter['quantity']?></td>
                                                        <td><?php echo "P". $filter['total'] ?></td>
                                                    </tr>
                                                    <input type="hidden" value="<?php $total = $sum +=$filter['total'] ?>">
                                                    <?php }?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <?php if(isset($total)){?>
                                                                <td class='text-red-500'><?php echo "P".$total;?></td>
                                                            <?php }?>
                                                    
                                                    </tr>
                                                <?php }else{?>
                                                    <?php foreach($datas as $data){?>
                                                        <tr>
                                                            <td><?php echo $data['time']?></td>
                                                            <td><?php echo $data['product_name'];?></td>
                                                            <td><?php echo $data['quantity'];?></td>
                                                            <td><?php echo $data['total'];?></td>
                                                        </tr>
                                                        <input type="hidden" value="<?php $total = $sum +=$data['total'] ?>">
                                                    <?php }?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <?php if(isset($total)){?>
                                                                <td class='text-red-500'><?php echo "P".$total;?></td>
                                                            <?php }?>
                                                        </tr>
                                                <?php }?>
        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <!-- table end -->
        </form>
        <!-- Form end -->
    </div>

   


   
 