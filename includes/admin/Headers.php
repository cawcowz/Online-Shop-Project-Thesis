<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin.css/header.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class='bg-gray-100 flex'> 
    <div class="container  md:text-sm text-[10px] md:w-[200px] w-[100px] border-2 px-1 min-h-screen bg-white">
        <div class=" border-red-500 w-full p-2 hover:border-red-500 hover:border bg-red-500 text-white cursor-pointer" id="dashboard">
            Dashboard
        </div>
        <div class=" w-full hover:border-red-500 hover:border p-2 cursor-pointer" id="orders">
            Orders
        </div>
        <div class=" w-full hover:border-red-500 hover:border p-2 cursor-pointer" id="products">
            Products
        </div>
        <div class=" w-full hover:border-red-500 hover:border p-2 cursor-pointer" id="stocks">
            Stocks
        </div>
        <div class=" w-full hover:border-red-500 hover:border p-2 cursor-pointer" id="sales">
            Sales
        </div>
        <div class=" w-full hover:border-red-500 hover:border  p-2 cursor-pointer" id="history">
            History
        </div>
        <div class=" w-full hover:border-red-500 hover:border  p-2 cursor-pointer" id="Messages">
            Messages
        </div>
    </div>
    <div id = "display">
        
    </div>
</body>
</html>

<script>
    const dashboard = document.getElementById("dashboard");
    dashboard.addEventListener("click",function(e){
        e.preventDefault();
        dashboard.style.borderColor  = "green";
    })
    $(document).ready(function(){
        $("#dashboard").click(function(){
            $("#dashboard").css("background","rgb(239 68 68)");
            $("#dashboard").css("color","white");
            $("#orders").css("background","white");
            $("#orders").css("color","black");
            $("#products").css("background","white");
            $("#products").css("color","black");
            $("#stocks").css("background","white");
            $("#stocks").css("color","black");
            $("#sales").css("background","white");
            $("#sales").css("color","black");
            $("#history").css("background","white");
            $("#history").css("color","black");
            $("#Messages").css("background","white");
            $("#Messages").css("color","black");
        })
        $("#orders").click(function(){
            $.ajax({
                url    : "Order.php",
                method : "POST",
                data    : $("#display").serialize(),
                success: function(response){
                    $("#display").html(response);
                    
                }
            })
            $("#dashboard").css("background","white");
            $("#dashboard").css("color","black");
            $("#orders").css("background","rgb(239 68 68)");
            $("#orders").css("color","white");
            $("#products").css("background","white");
            $("#products").css("color","black");
            $("#stocks").css("background","white");
            $("#stocks").css("color","black");
            $("#sales").css("background","white");
            $("#sales").css("color","black");
            $("#history").css("background","white");
            $("#history").css("color","black");
            $("#Messages").css("background","white");
            $("#Messages").css("color","black");
        })
        $("#products").click(function(){
            $("#dashboard").css("background","white");
            $("#dashboard").css("color","black");
            $("#orders").css("background","white");
            $("#orders").css("color","black");
            $("#products").css("background","rgb(239 68 68)");
            $("#products").css("color","white");
            $("#stocks").css("background","white");
            $("#stocks").css("color","black");
            $("#sales").css("background","white");
            $("#sales").css("color","black");
            $("#history").css("background","white");
            $("#history").css("color","black");
            $("#Messages").css("background","white");
            $("#Messages").css("color","black");
        })
        $("#stocks").click(function(){
            $("#dashboard").css("background","white");
            $("#dashboard").css("color","black");
            $("#orders").css("background","white");
            $("#orders").css("color","black");
            $("#products").css("background","white");
            $("#products").css("color","black");
            $("#stocks").css("background","rgb(239 68 68)");
            $("#stocks").css("color","white");
            $("#sales").css("background","white");
            $("#sales").css("color","black");
            $("#history").css("background","white");
            $("#history").css("color","black");
            $("#Messages").css("background","white");
            $("#Messages").css("color","black");
        })
        $("#sales").click(function(){
            $("#dashboard").css("background","white");
            $("#dashboard").css("color","black");
            $("#orders").css("background","white");
            $("#orders").css("color","black");
            $("#products").css("background","white");
            $("#products").css("color","black");
            $("#stocks").css("background","white");
            $("#stocks").css("color","black");
            $("#sales").css("background","rgb(239 68 68)");
            $("#sales").css("color","white");
            $("#history").css("background","white");
            $("#history").css("color","black");
            $("#Messages").css("background","white");
            $("#Messages").css("color","black");
        })
        $("#history").click(function(){
            $("#dashboard").css("background","white");
            $("#dashboard").css("color","black");
            $("#orders").css("background","white");
            $("#orders").css("color","black");
            $("#products").css("background","white");
            $("#products").css("color","black");
            $("#stocks").css("background","white");
            $("#stocks").css("color","black");
            $("#sales").css("background","white");
            $("#sales").css("color","black");
            $("#history").css("background","rgb(239 68 68)");
            $("#history").css("color","white");
            $("#Messages").css("background","white");
            $("#Messages").css("color","black");
        })
        $("#Messages").click(function(){
            $("#dashboard").css("background","white");
            $("#dashboard").css("color","black");
            $("#orders").css("background","white");
            $("#orders").css("color","black");
            $("#products").css("background","white");
            $("#products").css("color","black");
            $("#stocks").css("background","white");
            $("#stocks").css("color","black");
            $("#sales").css("background","white");
            $("#sales").css("color","black");
            $("#history").css("background","white");
            $("#history").css("color","black");
            $("#Messages").css("background","rgb(239 68 68)");
            $("#Messages").css("color","white");
        })
    })
</script>