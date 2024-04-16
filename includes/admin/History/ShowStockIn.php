<?php
if(isset($_POST['data'])){
    $stockin = $_POST['data'];
    $count = 1 ;
    $pdo =  new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM inventory_history WHERE status = ? ORDER BY id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($stockin));
    $datas= $stmt->fetchALl(PDO::FETCH_ASSOC);
    if($stmt->rowCount() >0){?>

<div class="table-container overflow-y-scroll h-[470px]">
    <table class="w-full" id="table" >
        <thead class="bg-gray-900">
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quanity</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($datas as$data){?>
            
            <tr>
                <td><?php echo $count++?></td>
                <td><?php echo $data['time']?></td>
                <td><?php echo $data['product_name']?></td>
                <td><?php echo $data['price']?></td>
                <td><?php echo $data['quantity']?></td>
                <td><?php echo $data['supplier']?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
}else{?>
     <div class='w-full text-center mt-10    '>
        <h1 class='text-lg text-teal-500'>No Data Found </h1>
        <i class=" text-4xl text-teal-600 fa-solid fa-book"></i>
    </div>
<?php }}?>