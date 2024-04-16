<?php

if(isset($_POST['data'])){
    $failed = $_POST['data'];
    $count = 1 ;
    $pdo =  new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM records WHERE action = ? ORDER BY id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($failed));
    $datas= $stmt->fetchALl(PDO::FETCH_ASSOC);
    if($stmt->rowCount() >0){
    ?>
<table>
<tr class='bg-gray-900 text-white' >
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
    <?php foreach($datas as$data){
    ?>
    <tr>
        <td><?php echo $count++?></td>
        <td><?php echo $data['time']?></td>
        <td><?php echo $data['Full_name']?></td>
        <td><?php echo $data['product_name']?></td>
        <td><?php echo $data['quantity']?></td>
        <td><?php echo $data['total']?></td>
        <td><?php echo $data['address']?></td>
        <td><img src="admin.includes/uploads/<?php echo $data['img']; ?>" width="60"alt=""></td>
        <td><?php echo $data['action']?></td>
    </tr>
    <?php }?>
</table>
<?php }else{?>
    <div class='w-full text-center mt-10    '>
        <h1 class='text-lg text-teal-500'>No Data Found </h1>
        <i class=" text-4xl text-teal-600 fa-solid fa-book"></i>
    </div>

<?php }}?>
