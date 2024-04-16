<?php

// if(isset($_POST['submit'])){
//     $email = $_POST['email'];
//     $uid = $_POST['uid'];
//     $pwd = $_POST['pwd'];
//     $pwdRepeat = $_POST['pwdRepeat'];
//     $user_id = strtoupper('user'.uniqid());
//     // Instantiate SignupController Class
//     include_once './includes/classes/Db.php';
//     include_once './includes/classes/Signup.classes.php';
//     include_once './includes/classes/SignupController.php';

//     $signup = new SignupController($uid,$pwd,$pwdRepeat,$email,$user_id);

//     //running error handler
//     $signup->signupUser();


//     // //redirection to home page
//     // echo "Register success!.. Alert You can now Login your account!";
//     echo "<script type='text/javascript'>alert('Register success!.. Alert You can now Login your account!');</script>";
//     header("location:Login.php");
// }

// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/signup.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class='bg-gray-100 p-20 font-[poppins]'>
    <!-- Newsletter -->
    <section id="newsletter" class="newsletter">
            <div class="newsletter-content container">

                <!-- Form  -->
                <!-- <form id='form' action="" class='' method="post"> -->
                    <?php
                        if(isset($_GET['error'])){?>
                            <div class="error"> <?php echo "Invalid ". $_GET['error'] ." !"?> </div>
                            <?php // echo "<script>alert('Inavlid $_GET[error]');</script>"?>
                        <?php }?>
                        
                        <div class='container mx-auto flex border-2 bg-white w-4/12 hover:shadow-sm duration-300 hover:shadow-red-400'>

                            <div class='border w-full px-2 pb-5 pt-5 flex flex-col justify-between '>
                                <h1 class='font-semibold text-3xl text-red-800 text-center'>BLJC</h1>
                                <h1 class='text-center text-md'> Create Account</h1>
                                <div class='mt-3 flex flex-col text-sm mb-7'>
                                    <input type="text" name="uid" id='gmail'  class='gmail p-2 border mt-1' placeholder=" Email address" required>
                                    <input id='emailMessage' class='outline-none' readonly type="text" hidden>

                                    <input type="text" name="uid" id='userInput'  class='p-2 border mt-1' placeholder="Username" required>
                                    <input id='userMessage' class='outline-none' readonly type="text" hidden>

                                    <input type="password" name="pwd" id='pwdInput' class='p-2 border mt-1' placeholder="Password" required>
                                    
                                    <!-- <p><?php $error ?></p> -->
                                    <input type="password" name="pwdRepeat" id='pwdRepeat' class='p-2 border mt-1' placeholder="Confirm password" required>
                                    <input type="text" class='outline-none' id='pwdMessage' hidden>
                                    <!--  -->
                                    <div class='text-[13px] text-red-600 mt-1'id='errMesage'></div>
                                </div>
                                <div class='flex flex-col'>
                                    <button class='bg-red-700 rounded text-white py-1' id='registerBtn'>Register</button>
                                    <!-- <input type="button" class='bg-red-700 rounded text-white py-1' id='registerBtn'value="Register" name="submit" class="btn registerBtn"> -->
                                    <a href="login.php" class='text-[13px] text-blue-400 text-center'>Already have account?</a>
                                    <a href="index.php" class="text-center text-[13px] text-gray-700 "> <i class='bx bx-arrow-back'></i> Back</a>
                                </div>
        
                            </div>

                        </div>
                <!-- </form> -->
               <div id='redirect'></div>
            </div>
        </section>
</body>
</html>
<script src="signupController/signup.js"></script>
<script>
    $(document).ready(function(){
            $("#registerBtn").click(function(){
                var gmail = $("#gmail").val();
                var userInput = $("#userInput").val();
                var pwdInput = $("#pwdInput").val();
                var pwdRepeat = $("#pwdRepeat").val();
                if(userInput != '' && pwdInput != '' &&  pwdRepeat != ''){
                    $.ajax({
                        url     : "signupController/registerUser.php",
                        method  : "POST",
                        data    :{
                            email : gmail,
                            user : userInput,
                            password : pwdInput,
                            passwordR : pwdRepeat
                        },
                        success     : function(response){
                            $("#errMesage").html(response);
                            // alert(response);
                            if(response == 'Successfully Register'){
                                window.location.reload();
                                $(window).attr('location','Login.php')
                            }
                        }
                    })
                }
            })
    })
</script>
