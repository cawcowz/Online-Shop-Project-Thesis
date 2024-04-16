 
 
 <!-- table -->
    <div class="tabular--wrapper border  border-sky-500">
                                <span class="main--title text-lg">Refresh</span>
                                <button class="rounded text-xl p-2" name="refresh" type="submit"><i class="fa-solid fa-arrows-rotate"></i></button>

                                
                                <!-- end button -->
                            <div class="table-container overflow-y-scroll h-[470px]">
                                <table class="">
                                    <thead class="bg-gray-900">
                                            <tr>
                                                <th>No.</th>
                                                <th>Product</th>
                                                <th>Stocks</th>
                                                <th>Sold</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>


                <?php if(isset($_POST['input'])){
                    $input = $_POST['input'];
                    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
                    $query = "SELECT * FROM inventory_table WHERE  product_name LIKE ? OR category LIKE ? OR sold LIKE ?";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(array("%".$input."%","%".$input."%","%".$input."%"));
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $count = 1;
                    if($stmt->rowCount() > 0){?>
                                        <?php foreach($rows as $row){?>
                                            <tr>
                                                <td><?php echo $count++;?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td> <?php echo $row['stocks']?></td>
                                                <td> <?php echo $row['sold']?></td>
                                                <td><img src="admin.includes/uploads/<?php echo $row['image']; ?>" width="60"alt=""></td>
                                                <td>
                                                    <a href="admin.includes/STOCK.STOCKOUT/stockin.php?uniqid=<?php echo $row['uniqid']?>">Edit</a>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <!-- table end -->
                    <?php }else{ ?>
                        <div class='w-full flex justify-center mb-2'>
                            <p class='text-lg text-red-600 font-semibold'>No Data found</p>
                        </div>
                    <?php }
                }?>
                       
 

  

           