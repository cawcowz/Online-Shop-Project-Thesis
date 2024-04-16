<?php
// include_once '../admin.classes/prodcut.classes.php';
// action="../admin.classes/product.classes.php"
$db = new PDO("mysql:host=localhost;dbname=inventory_system",'root','');

$id = $_GET['id'];
$query = "SELECT * FROM inventory_table WHERE Id = ?";
$stmt = $db->prepare($query);
$stmt->execute(array($id));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['updateProduct'])){
     //variable 
     $pdc = $_POST['product_code'];
     $pdn = $_POST['product_name'];
     $des = $_POST['description'];
     $am = $_POST['price'];
     $discount = $_POST['discount'];
     $stocks= $_POST['stocks'];
     $category = $_POST['category'];
     $brand = $_POST['brand'];
     $weight = $_POST['weight'];

     $image = $_FILES['image'];
      
        $query = "UPDATE  inventory_table SET product_code = ? , product_name = ?, description = ?, price = ? ,stocks = ?, category =?, discount =? ,brand = ? , weight = ? WHERE Id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute(array($pdc,$pdn,$des,$am,$stocks,$category,$discount,strtolower($brand),$weight,$id));
          
        header("location:../products.php");
        if($_FILES["image"]["error"] == 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
          }
          else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
        
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if ( !in_array($imageExtension, $validImageExtension) ){
              echo
              "
              <script>
                alert('Invalid Image Extension');
              </script>
              ";
            }
            else if($fileSize > 1000000){
              echo
              "
              <script>
                alert('Image Size Is Too Large');
              </script>
              ";
            }
            else{
              $newImageName = uniqid();
              $newImageName .= '.' . $imageExtension;
        
              move_uploaded_file($tmpName, 'uploads/' . $newImageName);
            //   // $query = "INSERT INTO image VALUES('', '$name', '$newImageName')";
              $query = "UPDATE inventory_table SET image = ? WHERE Id = ?";
      
            //   // mysqli_query($conn, $query);
              $stmt = $db->prepare($query);
            //   $stmt->execute(array($name,$newImageName));
            // $stmt->bindValue(':img',$newImageName);
            $stmt->execute(array($newImageName,$id));
            }
          }
    
  
      
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;1,200&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/brands.min.css" integrity="sha512-W/zrbCncQnky/EzL+/AYwTtosvrM+YG/V6piQLSe2HuKS6cmbw89kjYkp3tWFn1dkWV7L1ruvJyKbLz73Vlgfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-[Poppins]">
    <div class="bg-gray-100 w-full h-[100%] p-5">
        <div class=" w-[400px] m-auto mt-5  h-auto md:w-[800px] bg-white rounded shadow-xl">
            <!-- form -->
            <form class=" h-[100%]  p-2 "  method="post" autocomplete="off" enctype="multipart/form-data">
              <div class="w-full ">
                <!-- Back button -->
                  <a href="../Products.php"class="ml-5 p-2 underline "> <span>Back</span></a>
                  <!-- Back Button End -->
                  <div class="w-full p-5 ">
                      <h1 class=" text-3xl md:text-5xl text-center  mt-3 font-extrabold ">EDIT PRODUCT</h1>
                  </div>
              </div>
               <div class="md:flex p-5">

                   <div class="mt-5">
                       <!-- Product code -->
                       <label for="product_code" class="ml-3 ">Product code:</label><br>
                       <input type="text" id="product_code" name="product_code" value="<?php echo $row['product_code']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                       <!-- Product name -->
                       <label for="product_name" class="ml-3 ">Product name:</label><br>
                       <input type="text" id="product_name" name="product_name" value="<?php echo $row['product_name']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                       <!-- Description -->
                       <label for="description" class="ml-3 ">Description:</label><br>
                       <textarea id="description" name="description" rows="3" value="" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2"><?php echo $row['description']; ?></textarea>
                           <!-- Image -->
                       
                        <img id="image"src="uploads/<?php echo $row['image']?>" width="100"alt="">
                        <label for="img">Update Image</label><br>
                        <input type="file" accept=".jpg , .jpeg , .png" name="image" id="img">
                   </div>

                   <div class="md:ml-5 mt-5">
                       <!-- Product Weight -->
                       <label for="weight" class="ml-3 "> Weight:</label><br>
                       <input type="text" id="weight" name="weight" value="<?php echo $row['weight']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                       <!-- Product Price -->
                       <label for="price" class="ml-3 "> Amount:</label><br>
                       <input type="text" id="price" name="price" value="<?php echo $row['price']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                       <!-- Discount -->
                       <label for="Discount" class="ml-3 "> Discount:</label><br>
                         <input type="text" id="Discount" name="discount" value="<?php echo $row['discount']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                              <!-- Product stocks -->
                       <label for="stocks" class="ml-3 "> Stocks:</label><br>
                       <input type="text" id="stocks" name="stocks" value="<?php echo $row['stocks']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                              <!-- Product Brand -->
                       <label for="stocks" class="ml-3 "> Brand:</label><br>
                       <input type="text" id="stocks" name="brand" value="<?php echo $row['brand']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                        <!-- Category -->
                            <label for="category" class="ml-3 ">Category:</label><br>
                              <input type="text" id="category" name="category" value="<?php echo $row['category']?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">

                              <?php 
                                $db = new PDO("mysql:host=localhost;dbname=inventory_system",'root','');
                                $query = "SELECT * FROM inventory_table";
                                $stmt = $db->prepare($query);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);  
                            ?>
                           <select name="categories" id="categories"  onchange="getSelectedValue()">
                            <option value="">select..</option>
                            <?php do{?>
                            <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ;?></option>
                            <?php }while( $row = $stmt->fetch(PDO::FETCH_ASSOC)) ?>
                           </select>

                            <script>
                                function getSelectedValue(){
                                    var selectedValue = document.getElementById('categories').value;
                                    var category = document.getElementById('category');
                                    category.setAttribute("value",selectedValue);
                                    category.classList.toggle("active");
                                }
                            </script>

                       <!-- Buttons -->
                       <div class="buttons w-[100]  text-right mt-5">
                            <button type="submit" name="updateProduct" class="bg-gray-500 hover:bg-[#de0724] rounded text-white font-bold p-3 mt-5 text-right">Save Change </button>
                       </div>
                   </div>
               </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
    <script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("img").submit();
      };
    </script>
</body>
</html>