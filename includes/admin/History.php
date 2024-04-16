<?php
session_start();
    include 'SettingController/settingController.php';
    $settings = new AdminSettingsController();
    $profilePicture= $settings->displayImg($_SESSION['admin_id']);
    
    require_once 'admin.includes/ProductController.php';
        $db = new ProductController();
        $rows = $db->DisplayRecords(); ?>
        <?php $count = 1;
?>

<title>History</title>
<?php include_once 'Header.php';?>

 <!-- Dashboard -->
 <div class="main--content">
    <!-- form -->
    <form action="" method="post"  >
        <div class="header--wrapper">
            <div class="header--title">
                <!-- <span>Primary</span> -->
                <h2 class="text-4xl">History</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>

                    <input type="text" name="searchInput" class="text-gray-900" id="search" >

                    <input type="submit"  class="text-gray-900 " name="search" value="search">
                </div>
                <a href="AdminProfile.php?success=?" class='flex items-center'>
                    <?php foreach($profilePicture as $profile){?>
                        <img src="ProfilePicture/<?php echo $profile['img']?>" alt="">
                    <?php }?>
                    <h1 class='text-sm bg-gray-100 p-2 rounded-xl'><?php echo $_SESSION['user_admin']?></h1>
                </a>
            </div>
        </div>  
        <!-- Search Start -->

                   <!-- table -->
                   <div class="tabular--wrapper border  border-sky-500 w-full" >
                                <!-- Start Buttons filter -->
                                <div class='flex w-full'>
                                    <button type='submit' name='success'class='bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm mb-2 hover:scale-105 duration-300' id="delivered">Delivered</button>
                                    <button type='submit' name = 'failed'class='bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm shadow-lg ml-2 mb-2 hover:scale-105 duration-300' id="failed">Failed</button>
                                    <button type='submit' name = 'failed'class='bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm shadow-lg ml-2 mb-2 hover:scale-105 duration-300' id="stockOut">Stock out</button>
                                    <button type='submit' name = 'failed'class='bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm shadow-lg ml-2 mb-2 hover:scale-105 duration-300' id="stockIn">Stock in</button>
                                    <button type='submit' name='success'class='ml-3 bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm mb-2 hover:scale-105 duration-300' id="cancelled">Cancelled</button>
                                    <button type='submit' name='success'class='ml-3 bg-gray-200 py-1 px-2 text-sm rounded-md drop-shadow-sm mb-2 hover:scale-105 duration-300' id="refund">Refund</button>
                                </div>
                                
                                <!-- end button -->
                            <div class="table-container overflow-y-scroll h-[470px] w-full">
                                <table class="w-full" id="table" >
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
                                    <tbody id="displayData" class='w-full'>
                                        <?php foreach($rows as $row){?>
                                            <tr>
                                            <td><?php echo $count++?></td>
                                            <td><?php echo $row['time']?></td>
                                            <td><?php echo $row['Full_name']?></td>
                                            <td><?php echo $row['product_name']?></td>
                                            <td><?php echo $row['quantity']?></td>
                                            <td><?php echo $row['total']?></td>
                                            <td><?php echo $row['address']?></td>
                                            <td><img src="admin.includes/uploads/<?php echo $row['img']; ?>" width="60"alt=""></td>
                                            <td><?php echo $row['action']?></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>

                                <div id='displayTable'></div>
                                <div id="stocksHistory"></div>
                            </div>
                    </div>

                    <!-- Stock out / Stock In -->
        </form>
        <!-- Form end -->
    </div>

    <!-- Jquery / Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $("document").ready(function(){
            $("form").submit(function(event){
                event.preventDefault();
                
                // Success 
                $("#delivered").click(function(){
                    $.ajax({
                        url      : "History/ShowDelivered.php",
                        method   : "POST",
                        data     : {
                            data : "Delivered"
                        },
                        success  : function (response){
                            $("#displayTable").html(response);
                            $("#displayData").css("display",'none');
                            $("#delivered").css("color","red");
                            $("#failed").css("color","black");
                            $("#stockOut").css("color","black");
                            $("#table").css("display","none");
                            $("#stocksHistory").css("display","none");
                            $("#stockIn").css("color","black");
                            $("#cancelled").css("color","black");
                            $("#refund").css("color","black");
                            $("#displayTable").css("display","block");
                        }
                    })
                })
                // Failed
                $("#failed").click(function(){
                    $.ajax({
                        url      : "History/ShowFailed.php",
                        method   : "POST",
                        data     : {
                            data : "Failed"
                        },
                        success  : function (response){
                            $("#displayTable").html(response);
                            $("#failed").css("color","red");
                            $("#delivered").css("color","black");
                            $("#stockOut").css("color","black");
                            $("#table").css("display","none");
                            $("#stocksHistory").css("display","none");
                            $("#stockIn").css("color","black");
                            $("#cancelled").css("color","black");
                            $("#refund").css("color","black");
                            $("#displayTable").css("display","block");
                        }
                    })
                })
                // Stock out
                $("#stockOut").click(function(){
                    $.ajax({
                        url      : "History/ShowStockOut.php",
                        method   : "POST",
                        data     : {
                            data : "Delivered"
                        },
                        success  : function (response){
                            $("#stocksHistory").html(response);
                            $("#stockOut").css("color","red");
                            $("#failed").css("color","black");
                            $("#delivered").css("color","black");
                            $("#table").css("display","none");
                            $("#displayTable").css("display","none");
                            $("#stocksHistory").css("display","block");
                            $("#stockIn").css("color","black");
                            $("#refund").css("color","black");
                            $("#cancelled").css("color","black");
                        }
                    })
                })
                // Stock in
                $("#stockIn").click(function(){
                    $.ajax({
                        url      : "History/ShowStockIn.php",
                        method   : "POST",
                        data     : {
                            data : "Added Stocks"
                        },
                        success  : function (response){
                            $("#stocksHistory").html(response);
                            $("#stockIn").css("color","red");
                            $("#stockOut").css("color","black");
                            $("#failed").css("color","black");
                            $("#delivered").css("color","black");
                            $("#cancelled").css("color","black");
                            $("#refund").css("color","black");
                            $("#table").css("display","none");
                            $("#displayTable").css("display","none");
                            $("#stocksHistory").css("display","block");
                        }
                    })
                })
                // Cancelled
                $("#cancelled").click(function(){
                    $.ajax({
                        url      : "History/ShowCancelled.php",
                        method   : "POST",
                        data     : {
                            data : "Cancelled"
                        },
                        success  : function (response){
                            $("#displayTable").html(response);
                            $("#stockIn").css("color","black");
                            $("#stockOut").css("color","black");
                            $("#failed").css("color","black");
                            $("#cancelled").css("color","red");
                            $("#delivered").css("color","black");
                            $("#refund").css("color","black");
                            $("#table").css("display","none");
                            $("#stocksHistory").css("display","none");
                            $("#displayTable").css("display","block");
                        }
                    })
                })
                // refund
                $("#refund").click(function(){
                    $.ajax({
                        url      : "History/ShowRefund.php",
                        method   : "POST",
                        data     : {
                            data : "Refund"
                        },
                        success  : function (response){
                            $("#displayTable").html(response);
                            $("#stockIn").css("color","black");
                            $("#stockOut").css("color","black");
                            $("#failed").css("color","black");
                            $("#cancelled").css("color","black");
                            $("#refund").css("color","red");
                            $("#delivered").css("color","black");
                            $("#table").css("display","none");
                            $("#stocksHistory").css("display","none");
                            $("#displayTable").css("display","block");
                        }
                    })
                })
            })
        })
    </script>


   
 