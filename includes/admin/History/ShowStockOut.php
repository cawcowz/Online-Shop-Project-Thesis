<?php
if(isset($_POST['data'])){
    $delivered = $_POST['data'];
    $count = 1 ;
    $pdo =  new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM records WHERE action = ? ORDER BY id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($delivered));
    $datas= $stmt->fetchALl(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0) {?>


<div class="table-container overflow-y-scroll h-[470px]">
    <table class="w-full" id="table" >
        <thead class="bg-gray-900">
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Name</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($datas as$data){?>
            <tr>
                <td><?php echo $count++?></td>
                <td><?php echo $data['time']?></td>
                <td><?php echo $data['Full_name']?></td>
                <td><?php echo $data['product_name']?></td>
                <td><?php echo $data['total']?></td>
                <td class=''><?php echo $data['quantity']?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<?php }else{?>
     <div class='w-full text-center mt-10    '>
        <h1 class='text-lg text-teal-500'>No Data Found </h1>
        <i class=" text-4xl text-teal-600 fa-solid fa-book"></i>
    </div>
<?php }}?>