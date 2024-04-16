<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css/header.css">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script> 

    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="sidebar ">
        <!-- <div class="logo"></div> -->
        <ul class="menu flex flex-col justify-between min-h-screen  ">
            <div class='py-5'>
                    <li class=" dashboard p-2">
                        <a href="Admin.php" >
                            <i class='bx bxs-dashboard'></i>
                            <span class=''>Dashboard</span>
                        </a>
                    </li>
                    <li class="products p-2">
                        <a href="Products.php">
                        <i class="fa-brands fa-product-hunt"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="orders p-2">
                        <a href="Order.php" >
                            <i class='bx bxs-cart'></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li class="suppliers p-2">
                        <a href="ship.php">
                            <!-- <i class="fa-solid fa-truck-field"></i> -->
                            <i class="fa-solid fa-box"></i>
                            <span>Ship</span>
                        </a>
                    </li>
                    <li class="deliver p-2">
                        <a href="Receive.php">
                            <i class="fa-solid fa-truck-field"></i>
                            <span>Receive</span>
                        </a>
                    </li>
                    <li class="deliver p-2">
                        <a href="Refund.php">
                        <i class="fa-solid fa-box-open"></i>
                            <span>Refund</span>
                        </a>
                    </li>

                    <li class="stocks p-2">
                        <a href="Stocks.php">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                            <span>Stocks</span>
                        </a>
                    </li>
                    <li class="stocks p-2">
                        <a href="Sales.php">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                            <span>Sales</span>
                        </a>
                    </li>
                    <li class="stocks p-2">
                        <a href="Messages.php">
                        <i class="fa-solid fa-message"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li class="settings p-2">
                        <a href="History.php">
                        <i class='bx bx-file-blank' ></i> 
                            <span>History</span>
                        </a>
                    </li>
                    <li class="settings p-2">
                        <a href="Settings.php">
                        <i class="fa-solid fa-user"></i>
                            <span>Accounts</span>
                        </a>
                    </li>
                    </div>
                    <li class="logout p-2">
                        <a href="Logout.php" >
                            <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
        </div>
</div>

    

