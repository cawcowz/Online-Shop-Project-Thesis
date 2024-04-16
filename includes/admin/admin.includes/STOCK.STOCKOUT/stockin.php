<?php
session_start();
    $uniqid = $_GET['uniqid'];
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    
    if(isset($_POST['addStock'])){
        $inputStocks = $_POST['inputStocks'];
        if($inputStocks == ''){
            $inputStocks = 0;
        }else{
            $query = "SELECT * FROM inventory_table WHERE uniqid = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($uniqid));
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $supplier = $_POST['supplier'];
            foreach($datas as $data){
                $addedStocks = $inputStocks + $data['stocks'];
                $query = "UPDATE inventory_table SET stocks = ? WHERE uniqid = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array($addedStocks,$uniqid));        

                // Add to History
               $queryRecords = "INSERT INTO inventory_history (product_name,stocks,price,status,uniqid,quantity,supplier) VALUES(?,?,?,?,?,?,?) ";
               $stmtRecords = $pdo->prepare($queryRecords);
               $stmtRecords->execute(array($data['product_name'],$data['stocks'] + $inputStocks,$data['price'],"Added Stocks",$uniqid,$inputStocks,$supplier));
            }
            // Supplier

            // $queryUpdate = "UPDATE inventory_history SET supplier = ? WHERE uniqid = ?";
            // $stmtUpdate = $pdo->prepare($queryUpdate);
            // $stmtUpdate->execute(array($supplier,$uniqid));

            echo "<script>alert('Successfully added')</script>";
            // header("location: ../../Stocks.php");

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stock</title>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script> 

<!-- <link rel="stylesheet" href="style.css"> -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="print.css" media='print'>
    
</head>
<body class='p-10'>
    <form action="" method="post">
        <div class='border mx-auto md:w-5/12 p-1'>
            <div class='text-end'>
                <a href="../../Stocks.php" class='text-red-500 hover:scale-105 duration-300'>
                    <i class="fa-regular fa-circle-xmark"></i>
                </a>

            </div>
            <!-- Add stocks -->
            <div class='border mx-auto p-2 bg-gray-100/40'>
                <h1 class='text-red-700 text-lg'>Add Stocks</h1>
                <label for="inputText" class='text-sm'>Input number:</label>
                <input type="number" id='inputText' name='inputStocks' class='border px-1 w-[100px]' placeholder='0' >
                <br><br>
                <label for="" class="text-sm">Update Supplier:</label>
                <?php
                     $query = "SELECT supplier FROM inventory_table WHERE uniqid = ?";
                     $stmt = $pdo->prepare($query);
                     $stmt->execute(array($uniqid));
                     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     foreach($rows as $row){
                ?>
                    <input class='px-2 py-1 text-sm'type="text"name="supplier" placeholder="Update Supplier" value="<?php echo $row['supplier']?>">
                <?php }?>
                <div class='w-full mt-2'>
                    <button type="submit" name='addStock' class=' bg-yellow-500/80 px-3 py-1 rounded-md shadow-md hover:bg-yellow-500'>Update</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
