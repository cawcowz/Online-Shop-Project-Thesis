
<script src="https://cdn.tailwindcss.com"></script>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $("#Province").on('change',function(){
                var province_no = $(this).val();
                if(province_no){
                    $.ajax({
                    url     : "AdressController.php",
                    method     : "POST",
                    data    : {province : province_no},
                    success     : function(response){
                        $("#city").html(response);
                    }
                    })
                }else{
                    $("#city").html("<option value='' > Select province first</option>");
                }
            })
        })
    </script>

    <!-- COuntry -->

    <!-- For Province -->
<?php    $pdo = new PDO("mysql:host=localhost;dbname=phil_address","root",""); 
        $query = "SELECT * FROM province";
        $stmt = $pdo->prepare($query);
         $stmt->execute();
         $showProvinces = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <select class='p-2 text-sm text-gray-500 border mb-1 ' name="Province" id="Province">
        <option value="" >Province</option>
        <?php foreach($showProvinces as $showProvince){?>
            <option value="<?php echo $showProvince['province_no']?>"><?php echo $showProvince['provinces']?></option>
        <?php }?>
    </select>

    <select name="city" class='p-2 text-sm text-gray-500 border mb-1 ' id="city">
        <option value="">Select province first..</option>
    </select>
    <!-- Barangay -->
    <input type="text" placeholder='Street and Barangay ex.Purok 5, Sampaguita' class='p-2 border mb-1 text-sm '>

<?php
// refernce**
if(isset($_POST['save'])){
    $query = "SELECT * FROM province WHERE province_no = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($_POST['Province']));
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        foreach($datas as $data){
            echo $data['provinces'];
            $query = "SELECT * FROM city WHERE city_no = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($_POST['city']));
            $datas = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount()>0){
                echo " ".$datas['city_name'];
            }
        }
    }
}
// $provinces = ['Agusan del Sur','Aklan','Albay','Antique','Apayao','Aurora','Basilan','Bataan','Batanes','Batangas','Benguet','Biliran','Bohol','Bukidnon','Bulacan','Cagayan','Camarines Norte','Camarines Sur','Camiguin','Capiz','Catanduanes','Cavite','Cebu','Compostela Valley','Cotabato','Davao del Norte','Davao del Sur','Davao Oriental','Eastern Samar','Guimaras','Ifugao','Ilocos Norte','Ilocos Sur','Iloilo','Isabela','Kalinga','La Union','Laguna','Lanao del Norte','Lanao del Sur','Leyte','Maguindanao','Marinduque','Masbate','Metro Manila','Misamis Occidental','Misamis Oriental','Mountain Province','Negros Occidental','Negros Oriental','Northern Samar','Nueva Ecija','Nueva Vizcaya','Occidental Mindoro','Oriental Mindoro','Palawan','Pampanga','Pangasinan','Quezon','Quirino','Rizal','Romblon','Samar','Sarangani','Shariff Kabunsuan','Siquijor','Sorsogon','South Cotabato','Southern Leyte','Sultan Kudarat','Sulu','Surigao del Norte','Surigao del Sur','Tarlac','Tawi-Tawi','Zambales','Zamboanga del Norte','Zamboanga del Sur','Zamboanga Sibugay'];

// $cities = ['Alicia','Buug','Diplahan','Imelda','Ipil','Kabasalan',
// 'Mabuhay','Malangas','Naga','Olutanga','Payao','Roseller Lim',
// 'Siay','Talusan','Titay','Tungawan'];
// foreach($cities as $city){
//     $query = "INSERT INTO city(city_name,city_no) VALUES(?,?)";
//     $stmt = $pdo->prepare($query);
//     $stmt->execute(array($city,81));
    
// }
// $count = 3;
// foreach($provinces as $province){
//     $query = "INSERT INTO province(provinces,province_no) VALUES(?,?)";
//     $stmt = $pdo->prepare($query);
//     $stmt->execute(array($province,$count++));

// }
