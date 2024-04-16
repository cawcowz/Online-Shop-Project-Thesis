<?php
    session_start();
    if( isset($_SESSION['user_admin'])){
      if($_SESSION['is_admin'] == ''){
        header('location:../user/user.php');
      }
    };
    include 'SettingController/settingController.php';
    $settings = new AdminSettingsController();
    $profilePicture= $settings->displayImg($_SESSION['admin_id']);

    require_once 'admin.includes/ProductController.php';
    $db = new ProductController();
    $rows = $db->viewData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.cs/header.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<?php include_once 'Header.php';?>
    <!-- Dashboard -->
    <div class="main--content" id="dashboard_main">
        <div class="header--wrapper">
            <div class="header--title">
                <span class="text-black">BLJC</span>
                <h2 class="text-2xl">Dashboard</h2>
            </div>
            <a href='adminProfile.php?success=?' class="user--info">
                <?php foreach($profilePicture as $profile){?>
                    <img src="ProfilePicture/<?php echo $profile['img']?>" alt="">
                <?php }?>
                <h1 class='text-sm bg-gray-100 p-2 rounded-xl'><?php echo $_SESSION['user_admin']?></h1>
            </a>
        </div>

         <!-- Card Container -->
        <div class="card--container">
    
            <div class="card--wrapper">
                <!-- Card 1 -->
                <div class="payment--card light--red">
                    <h3 class="main--title">Today's Sales</h3>
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Payment amount
                            </span>
                            <span class="amount--value"><?php include_once "Dashboard/todaySale.php"?></span>
                        </div>
                        <i class="red icon fa-solid fa-peso-sign"></i>
                    </div>
                    <span class="card-detail">
                        --------
                    </span>
                </div>
                <!-- Card 2 -->
                <div class="payment--card light--yell">
                    <h3 class="main--title"> Critical Stocks</h3>
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Stocks
                            </span>
                            <span class="amount--value"><?php include_once "Dashboard/criticalStocks.php"?></span>
                        </div>
                        <i class="light--yellow icon fa-solid fa-chart-simple"></i>
                    </div>
                    <span class="card-detail">
                        --------
                    </span>
                </div>
                <!-- Card 3 -->
                <div class="payment--card light--green">
                    <h3 class="main--title">  Total Products</h3>
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Products
                            </span>
                            <span class="amount--value"><?php include_once "Dashboard/totalProducts.php"?></span>
                        </div>
                        <i class='dark--green icon fa-solid fa-arrow-trend-up '></i>
                    </div>
                    <span class="card-detail">
                        --------
                    </span>
                </div>
            </div>
        </div>

        <!-- form -->
        <form action="" method="post">
        
        <!-- table -->
        <div class="tabular--wrapper border  border-sky-500">
                <h3 class="main--title text-lg">List of Products</h3>
                <!-- <div class="text-right mb-2">
                    <a href="admin.includes/products.add.php" class="rounded-md bg-[#d0011b] p-2 text-sm  shadow hover:shadow-lg text-white">Add Product</a>
                </div> -->
            <div class="table-container overflow-y-scroll h-[250px]">
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
                        <?php $count = 1;?>
                        <?php foreach($rows as $row){?>
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
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
            <!-- table end -->
                </form>
                <!-- Form end -->
        <!-- </div> -->
        
    </div>
</body>
</html>

 