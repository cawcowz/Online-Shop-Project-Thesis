<?php
session_start();
    $unqid = $_GET['uniqid'];
    // $Full_name = $_GET['fn'];
    $user_id = $_SESSION['user_id'];

    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system",'root','');
    $query = "SELECT * FROM torate WHERE uniqid = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($unqid));
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['submit'])){
        $comment= $_POST['comment'];
        $rate = $_POST['star'];
        if($rate == 0){
           echo "<script type='text/javascript'>alert('Rate star');</script>";
           
        }else{
             // IMage
            if($_FILES["image"]["error"] == 4){
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;
            
                move_uploaded_file($tmpName, 'uploadsRatingPics/' . $newImageName);
                $_SESSION['addImage'] = $newImageName; 
            }else{
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
            
                move_uploaded_file($tmpName, 'uploadsRatingPics/' . $newImageName);
                $_SESSION['addImage'] = $newImageName; 
                // $query = "INSERT INTO rating SET img = ? ";
                // $stmt = $pdo->prepare($query);
                //     $stmt->execute(array($newImageName));
                }
            }
            foreach($datas as $data){
                $query = "SELECT uniqid FROM inventory_table WHERE product_name =?";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array($data['product_name']));
                $show = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $queryProfile = "SELECT img FROM users WHERE user_id =?";
                $stmtProfile = $pdo->prepare($queryProfile);
                $stmtProfile->execute(array($user_id));
                $profiles = $stmtProfile->fetchAll(PDO::FETCH_ASSOC);
                foreach($profiles as $profile){
                    $_SESSION['profile'] = $profile['img'];
                    // echo $_SESSION['profile'];
                }
                    // insert uniqid from inventory table to display in Product Description
                    foreach($show as $show){
                        $queryInsert = "INSERT INTO rating (Full_name,rating,comment,uniqid,img,profile_pic) VALUES (?,?,?,?,?,?)";
                        $stmtInsert = $pdo->prepare($queryInsert);
                        $stmtInsert->execute(array($data['Full_name'],$rate,$comment,$show['uniqid'],$_SESSION['addImage'],$_SESSION['profile']));
                    }

            }
            $queryDel = "DELETE FROM torate WHERE uniqid = ?";
            $stmtDel = $pdo->prepare($queryDel);
            $stmtDel->execute(array($unqid));

           
            header('location:ToRate.php');
        }
    
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BJLC Shop </title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class='p-10'>
    <div class='mx-auto md:w-6/12 w-full border p-2 shadow-lg'>
        <div class='mx-auto '>
            <a href="torate.php"><i class="fa-solid fa-arrow-left"></i></a>
            <h1 class='text-center text-xl'>Rate Product </h1>
            <div class='border-2 mt-2'></div>
            <?php foreach($datas as $data){?>
                <div class='flex flex-col items-center'>
                <img name='image' src="../../admin/admin.includes/uploads/<?php echo $data['img']; ?>" alt="" class='w-[250px] h-[250px] '>
                <span class='text-center border p-2'><?php echo $data['product_name'];?></span>
                </div>
            <?php }?>
            
            <form action="" method='post'  autocomplete="off" enctype="multipart/form-data">
                <!-- Rate Stars -->
                <div class='p-1 mt-2'>
                    <span class='font-semibold'>Product Quality</span> 
                </div>
                <!-- stars -->
                <div>
                    <input type="radio" name='star' value= "0" checked="checked" hidden>
                    <!-- 5 stars -->
                    <div>
                        <input type="radio" id="html" name="star" value="5" class='mr-3' ><i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i>
                    </div>
                    <!-- 4 stars -->
                    <div>
                        <input type="radio" id="html" name="star" value="4" class='mr-3' >
                        <i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i>
                    </div>
                    <!-- 3 stars -->
                    <div>
                        <input type="radio" id="html" name="star" value="3" class='mr-3' >
                        <i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i>
                    </div>
                    <!-- 2 stars -->
                    <div>
                        <input type="radio" id="html" name="star" value="2" class='mr-3' >
                        <i class="fa-solid fa-star text-yellow-500"></i><i class="fa-solid fa-star text-yellow-500"></i>
                    </div>
                    <!-- 1 stars -->
                    <div>
                        <input type="radio" id="html" name="star" value="1" class='mr-3' >
                        <i class="fa-solid fa-star text-yellow-500"></i>
                    </div>
                </div>

                <!-- Add image -->
       
                    <div class=''>
                        <label for="images"><i class="fa-regular fa-file-image text-2xl text-sky-400 mt-2"></i></label>
                        <label for="images" class='text-gray-400'>upload image</label>
                        <img id = ''src="uploadsRatingPics/" alt="" width="100">
                        <input type="file" hidden accept=".jpg , .jpeg , .png" name="image" id="images">
                    </div>
   
                <!-- Comments -->
                <div>
                    <div class='border p-2'>
                        <textarea name="comment" id="" cols="86" rows="5" placeholder='comment' class='p-1 '></textarea>
                    </div>
                </div>
                <button name='submit' class='w-full bg-yellow-200 hover:bg-yellow-400 duration-300 p-2 mt-2 text-gray-700'>Submit</button>
            </form>
        </div>
    </div>
</body>
</html>