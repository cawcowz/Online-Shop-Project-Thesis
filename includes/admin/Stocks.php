<?php 
session_start();
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM inventory_table";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $datas = $stmt->fetchALl(PDO::FETCH_ASSOC);
    $count = 1;
    include 'SettingController/settingController.php';
    $settings = new AdminSettingsController();
    $profilePicture= $settings->displayImg($_SESSION['admin_id']);
?>
    


<title>Stocks</title>
<?php include_once 'Header.php';?>

 <!-- Dashboard -->
 <div class="main--content">
    <!-- form -->
    <form action="" method="post"  >
        <div class="header--wrapper">
            <div class="header--title">
                <!-- <span>Primary</span> -->
                <h2 class="text-4xl">Stocks</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>

                    <input type="text" name="searchInput" placeholder="search"class="text-gray-900" id="search" >
                </div>
                <a href='' class='flex items-center'>
                    <?php foreach($profilePicture as $profile){?>
                        <img src="ProfilePicture/<?php echo $profile['img']?>" alt="">
                    <?php }?>
                    <h1 class='text-sm bg-gray-100 p-2 rounded-xl'><?php echo $_SESSION['user_admin']?></h1>
                </a>
                
            </div>
        </div>  
        <!-- Search Start -->
            <div id ="resultSearch" >

            </div>
        <!-- End Search Start -->

        <!-- Display Data -->
         <!-- table -->
    <div class="tabular--wrapper border  border-sky-500" id="table">
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
            <?php foreach($datas as $data){?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $data['product_name']; ?></td>
                        <td> <?php  if($data['stocks']  <= 0){echo 0;}else{echo $data['stocks'];} ?></td>
                        <td> <?php echo $data['sold']?></td>
                        <td><img src="admin.includes/uploads/<?php echo $data['image']; ?>" width="60"alt=""></td>
                        <td>
                            <a href="admin.includes/STOCK.STOCKOUT/stockin.php?uniqid=<?php echo $data['uniqid']?>"><i class="fa-solid fa-pen-to-square text-green-500 text-lg"></i></a>
                        </td>
                    </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    </div>
            <!-- table end -->
        <!--End Display Data -->
                  
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
                        url:"liveSearch/stockLiveSearch.php",
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
               
   


   
 