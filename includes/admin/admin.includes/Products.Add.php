<?php
// include_once '../admin.classes/prodcut.classes.php';
// action="../admin.classes/product.classes.php"

if(isset($_POST['addProduct'])){
     //variable 
     $pdc = $_POST['product_code'];
     $pdn = $_POST['product_name'];
     $des = $_POST['description'];
     $am = $_POST['price'];
     $discount = $_POST['discount'];
     $stocks= $_POST['stocks'];
     $category = $_POST['category'];
     $categories = $_POST['categories'];
     $supplier = $_POST['supplier'];
     $uniqid = uniqid();
     $brand = $_POST['brand'];
     $qnty = $_POST['qnty'];
     $weight = $_POST['weight'];
    //  $image = $_POST['image'];

     try{
        $db = new PDO("mysql:host=localhost;dbname=inventory_system",'root','');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO inventory_table(product_code,product_name,description,price,stocks,category,discount,image,uniqid,brand,quantity,supplier,weight) Values(:pdc,:pdn,:des,:am,:stocks,:category,:discount,:img,:uniqid,:brand,:quantity,:supplier,:weight)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':pdc',$pdc);
        $stmt->bindValue(':pdn',$pdn);
        $stmt->bindValue(':des',$des);
        $stmt->bindValue(':am',$am);
        $stmt->bindValue(':discount',$discount);
        $stmt->bindValue(':stocks',$stocks);
        $stmt->bindValue(':category',$category);
        $stmt->bindValue(':uniqid',$uniqid);
        $stmt->bindValue(':brand',$brand);
        $stmt->bindValue(':quantity',$qnty);
        $stmt->bindValue(':supplier',$supplier);
        $stmt->bindValue(':weight',$weight);
        
        if($_FILES["image"]["error"] == 4){
            echo
            header("location:Products.add.php?error=Please Upload photo");
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
            //   $query = "INSERT INTO image VALUES('', ?, ?)";
      
            //   // mysqli_query($conn, $query);
            //   $stmt = $db->prepare($query);
            //   $stmt->execute(array($name,$newImageName));
            $stmt->bindValue(':img',$newImageName);
              echo
              "
              <script>
                alert('Successfully Added');
              </script>
              ";
              header("location:../Products.php");
            }
          }

          $stmt->execute();
     }catch(PDOException $e){
        // echo $e->getMessage();
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
    <style>
        .active{
            display:block;
        }
    </style>
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
                      <h1 class=" text-3xl md:text-5xl text-center  mt-3 font-extrabold ">ADD PRODUCT</h1>
                  </div>
              </div>
               <div class="md:flex p-5">

                   <div class="mt-5">
                       <!-- quantity -->
                       <input type="hidden" name="qnty" value='1'>
                       <!-- Product code -->
                       <label for="product_code" class="ml-3 ">Product code:</label><br>
                       <input type="text" id="product_code" name="product_code" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2" require>
                       <!-- Product name -->
                       <label for="product_name" class="ml-3 ">Product name:</label><br>
                       <input type="text" id="product_name" name="product_name" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2" require>
                       <!-- Description -->
                       <label for="description" class="ml-3 ">Description:</label><br>
                       <textarea id="description" name="description" rows="3" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2"></textarea>
                           <!-- Image -->
                      <?php if(isset($_GET['error'])){?>
                          <p class='text-red-500'><?php echo $_GET['error']?>!</p>
                      <?php }?>
                       <div class="extraOutline p-4 bg-white w-max bg-whtie m-auto rounded-lg">
                            <div class="file_upload p-5 relative border-4 border-dotted border-gray-300 rounded-lg w-[250px] md:w-[450px] " >
                                <svg class="text-[#d0011b] w-24 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                                <div class="input_field flex flex-col w-max mx-auto text-center">
                                    <label>
                                        <input class="text-sm cursor-pointer w-36 hidden" type="file" multiple name ="image" accept=".jpg, .jpeg, .png"/>
                                        <div class="text bg-[#d0011b] text-white border border-gray-300 rounded font-semibold cursor-pointer p-1 px-3 hover:bg-[#de0724]">Select</div>
                                    </label>

                                    <div class="title  uppercase">Upload image</div>
                                </div>
                            </div>
                        </div>
                   </div>

                   <div class="md:ml-5 mt-5">
                       <!-- Weight  -->
                       <label for="weight" class="ml-3 "> Weight :</label><br>
                       <input type="text" id="weight" name="weight" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2" placeholder='kilogram' >
                       <!-- Product Price -->
                       <label for="price" class="ml-3 "> Amount:</label><br>
                       <input type="text" id="price" name="price" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2" require>
                       <!-- Discount -->
                       <label for="Discount" class="ml-3 "> Discount:</label><br>
                         <input type="text" id="Discount" name="discount" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                              <!-- Product stocks -->
                       <label for="stocks" class="ml-3 "> Stocks:</label><br>
                       <input type="text" id="stocks" name="stocks" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2" require>
                              <!-- Brand -->
                       <label for="stocks" class="ml-3 "> Brand:</label><br>
                       <input type="text" id="stocks" name="brand" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2">
                        <!-- Category -->
                            <label for="category" class="ml-3 ">Category:</label><br>
                              <input type="text" id="category" name="category" value="<?php if(isset($_POST['categories']))echo $categories?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2 none">
                    
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
                        <!-- Supplier -->
                        <br>
                            <label for="supplier" class="ml-3 ">Supplier:</label><br>
                              <input type="text" id="supplier" name="supplier" value="<?php if(isset($_POST['supplier']))echo $supplier?>" class="w-[95%] mt-3 ml-3 p-2   outline outline-gray-200 focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 rounded bg-[#fff] mb-2 none">
                    
                            <?php 
                                $db = new PDO("mysql:host=localhost;dbname=inventory_system",'root','');
                                $query = "SELECT * FROM inventory_table";
                                $stmt = $db->prepare($query);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);  
                            ?>
                           <select name="supplier" id="supplier"  onchange="getSelectedValue()">
                            <option value="">select..</option>
                            <?php do{?>
                            <option value="<?php echo $row['supplier'] ?>"><?php echo $row['supplier'] ;?></option>
                            <?php }while( $row = $stmt->fetch(PDO::FETCH_ASSOC)) ?>
                           </select>

                            <script>
                                function getSelectedValue(){
                                    var selectedValue = document.getElementById('supplier').value;
                                    var category = document.getElementById('supplier');
                                    category.setAttribute("value",selectedValue);
                                    category.classList.toggle("active");
                                }
                            </script>

                                
                       <!-- Buttons -->
                       <div class="buttons w-[100]  text-right mt-5">
                            <button type="submit" name="addProduct" class="bg-gray-500 hover:bg-[#de0724] rounded text-white font-bold p-3 mt-5 text-right">Confirm </button>
                       </div>
                   </div>
               </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</body>
</html>