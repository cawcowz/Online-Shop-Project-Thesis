<?php 
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM refund order by id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<title>Refund</title>
<?php include_once 'Header.php';?>

<!-- Dashboard -->
<div class="main--content">
    <!-- form -->
    <form action="" method="post"  >
        <div class="header--wrapper">
            <div class="header--title">
                <!-- <span>Primary</span> -->
                <h2 class="text-4xl">Refund</h2>
            </div>

        </div>  
        <!-- Search Start -->

                   <!-- table -->
                   <div class="tabular--wrapper border  border-sky-500">
                              
                            <div class="table-container overflow-y-scroll h-[470px]">
                                <table class="">
                                    <thead class="bg-gray-900">
                                            <tr>
                                                <th>No.</th>
                                                <th>Date</th>
                                                <th>Username</th>
                                                <th>Products</th>
                                                <th>Address</th>
                                                <th>Image</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Details</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($datas as $data){
                                        if($data['action'] == "Refund"){
                                        ?>
                                        <tr>
                                            <td><?php echo $count++?></td>
                                            <td><?php echo $data['time']?></td>
                                            <td><?php echo $data['Full_name']?></td>
                                            <td><?php echo $data['product_name']?></td>
                                            <td><?php echo $data['address']?></td>
                                            <td><img src="admin.includes/uploads/<?php echo $data['img']; ?>" width="60"alt=""></td>
                                            <td><?php echo "x".$data['quantity']?></td>
                                            <td><?php echo $data['total']?></td>
                                            <td><a href="viewRefund.php?uniqid=<?php echo $data['uniqid']?>" class='underline text-sky-500'>view</a></td>
                                            <!-- <td class='flex items-center justify-center'>
                                                <a class='bg-teal-500 p-2 rounded-md hover:bg-teal-400 text-white   ' href='AcceptRefund.php?uniqid=<?php echo $data['uniqid']?>'>Accept</a>
                                                <a class='bg-red-900 hover:bg-red-700 rounded-lg text-white p-2 ml-2' href='DeclineRefund.php?uniqid=<?php echo $data['uniqid']?>'>Cancel</a>
                                            </td> -->
                                        </tr>
                                    <?php } }?>
                                    </tbody>
                         </table>
        </form>
        <!-- Form end -->
    </div>
