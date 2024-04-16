<?php
session_start();
include 'SettingController/settingController.php';
$settings = new AdminSettingsController();
$profilePicture= $settings->displayImg($_SESSION['admin_id']);

    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM inventory_table ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;
    
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
                <h2 class="text-4xl">Products</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>

                    <input type="text" name="searchInput" class="text-gray-900" id="search" placeholder="search..">
                </div>
                <a href="AdminProfile.php?success=?" class='flex items-center'>
                    <?php foreach($profilePicture as $profile){?>
                        <img src="ProfilePicture/<?php echo $profile['img']?>" alt="">
                    <?php }?>
                    <h1 class='text-sm bg-gray-100 p-2 rounded-xl'><?php echo $_SESSION['user_admin']?></h1>
                </a>
            </div>
        </div>  
        <!-- Display Data Start -->
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
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <!-- table end -->
        <!-- Display Data End -->
                   
        <div id="resultSearch">

        </div>
        </form>
        <!-- Form end -->
    </div>
    

      <!-- Jquery / Ajax -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#search").keyup(function(){
                var input = $(this).val();
                if(input != ""){
                    $.ajax({
                        url:"liveSearch/pLiveSearch.php",
                        method:"POST",
                        data:{input:input},
                        success:function(data){
                            $("#resultSearch").html(data);
                            $("#resultSearch").css("display","block");
                            $("#table").css("display","none");
                        }
                    })
                }else{
                    $("#resultSearch").css("display","none");
                    $("#table").css("display","block");
                }
            })
        })
    </script>


   
 