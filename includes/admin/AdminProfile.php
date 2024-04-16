<?php
    session_start();
    $user_id = $_SESSION['admin_id'];

    // echo $username;
    include 'SettingController/settingController.php';
    $settings = new AdminSettingsController();
    $users= $settings->displayAccount($user_id);

    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $queryDisplay = "SELECT img FROM users WHERE user_id = ?";
    $stmtDisplay = $pdo->prepare($queryDisplay);
    $stmtDisplay->execute(array($user_id));
    $datas = $stmtDisplay->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_POST['upload'])){
         // IMage
         if($_FILES["image"]["error"] == 4){
            echo
            "<script> alert('Image Does Not Exist'); </script>"
            ;
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
            else if($fileSize > 100000000){
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
        
            move_uploaded_file($tmpName, 'ProfilePicture/' . $newImageName);
            // echo $newImageName;
            $_SESSION['addImage'] = $newImageName; 
            $query = "UPDATE users SET img = ? WHERE user_id = ? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($newImageName,$user_id));
            }
        }
        header("location:AdminProfile.php?success=Update success");
    }
    if(isset($_POST['update_username'])){
        $username= $_POST['username'];
        $settings->updateUsername($username,$user_id);
    }
    if(isset($_POST['update_email'])){
        $email= $_POST['email'];
        $settings->updateEmail($email,$user_id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class='p-10 font-[poppins]'>
    <div class='mx-auto w-5/12 p-2 border bg-gray-500/5 shadow-lg' >
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="text-xl mb-4">
                <a href="Admin.php">
                    <i class="fa-solid fa-arrow-left"></i> <span class='text-lg pl-2 font-semibold '> Profile </span>
                </a>

            </div>
            <div class='flex flex-col justify-center items-center '>
                <div>
                    <?php foreach($datas as $data){?>
                    <div class='flex flex-col items-center'>
                        <img class='w-[200px] h-[250px] rounded' name= "profile"src="ProfilePicture/<?php echo $data['img']?>" alt="" >
                        <input type="file" class='w-[200px]'  accept=".jpg , .jpeg , .png" name="image" id="images">
                    </div>
                    <?php }?>
                    <button type="submit" name="upload" class='bg-red-500 w-full p-1 mt-2 rounded-sm text-white'>Update Profile</button>
                    <?php if($_GET['success'] == "?"){?>
                        <span></span>
                    <?php } else{?>
                    <div class='w-full mt-2 text-center'>
                        <span class=' font-bold text-green-500 text-center w-full'> <?php echo $_GET['success']?></span>
                    </div>
                    <?php }?>
      
                </div>
                <div class='text-center'>
                     
                    <?php foreach($users as $user){?>
                    <label for="">Username :</label>
                    <input type="text" name='username' value='<?php echo $user['user_name']?>'  class='outline-none border px-2 text-sm'>
                    <button class='text-sm text-blue-400 underline' name='update_username'>Change</button><br>
                    <?php }?>
                    <?php foreach($users as $user){?>
                    <label for="">Email :</label>
                    <input type="text" name='email' value='<?php echo $user['email']?>'  class='outline-none border px-2 text-sm'>
                    <button class='text-sm text-blue-400 underline' name='update_email'>Change</button><br>
                    <?php }?>

                </div>
                
            </div>

        </form>
        
    </div>
</body>
</html>