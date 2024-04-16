
<?php 
    if(isset($_POST['input'])){
        $searchInput = $_POST['input'];
        $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
        $query = "SELECT * FROM inventory_table WHERE product_code LIKE ? OR product_name LIKE ? OR category LIKE ? OR brand LIKE ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array("%".$searchInput."%","%".$searchInput."%","%".$searchInput."%","%".$searchInput."%"));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = 1;
    }   
?>

<div class="tabular--wrapper border  border-sky-500" id= "table">
            <div class="text-right mb-2">
                <a href="admin.includes/products.add.php" class="rounded-md bg-[#d0011b] p-2 text-sm  shadow hover:shadow-lg text-white">Add Product</a>
            </div>
            <span class="main--title text-lg">List of product</span><button class="rounded text-xl p-2" name="refresh" type="submit"><i class="fa-solid fa-arrows-rotate"></i></button>
                              
            <div class="table-container overflow-y-scroll h-[470px]">
                <table class="">
                    <thead class="bg-gray-900">
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Stocks</th>
                            <th>Category</th>
                            <th>Discount</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($stmt->rowCount() > 0){
                            foreach($rows as $row){    
                        ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td><?php echo $row['product_code']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['stocks']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['discount']; ?></td>
                            <td><img src="admin.includes/uploads/<?php echo $row['image']; ?>" width="60"alt=""></td>
                            <td>
                                <a href="admin.includes/products.edit.php?id=<?php echo $row['Id'];?>"><i style="color: #06ac6d;" class=" text-xl mr-3  fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    
                                <a href="admin.includes/products.delete.php?id=<?php echo $row['Id'];?>" class="text-2xl"><i class='bx bxs-trash' ></i>
                                                    </a>
                            </td>
                        </tr>
                        <?php } }else{?>
                            <div class="flex w-full justify-center">
                                <p class='text-lg font-semibold text-red-600 mb-2'>No Data Found</p>
                            </div>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
            <!-- table end -->
