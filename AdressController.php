<?php
if(!empty($_POST['province'])){
    $province_no = $_POST['province'];
    $pdo = new PDO("mysql:host=localhost;dbname=phil_address","root",""); 
    $query = "SELECT * FROM city where city_no = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($province_no));
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        echo "<option value=''>Select City</option>";
        foreach($datas as $data){
            echo "<option value='$data[city_no]'>$data[city_name]</option>";
        }
    }else{
        echo "<option value = '' > Province not available</option>";
    }
}