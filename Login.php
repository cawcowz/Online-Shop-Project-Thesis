<?php
    include_once './includes/classes/Db.php';
    if(isset($_POST['login'])){
        $pwd = $_POST['pwd'];
        $uid = $_POST['uid'];
        header("Localhost:index.php?error=login");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header>
     <!-- Login Form -->
    <div class="login-form">
                <!-- Form -->
        <form  action= "includes/classes/LoginClasses.php" method="post">
            <h2>Login To Continue</h2>
            <?php if(isset($_GET['error'])){?>
                <p class="error"> <?php echo $_GET['error'] ;?> </p>
            <?php } ?>
          
            <input type="text" name="uid" id="username" placeholder="Username or Email address" required>
            <input type="password" name="pwd" id="password" placeholder="Password" required>
            <p class='text-start text-sm text-red-400' id='err'></p>
            <a class="forgot-pass" href="#">Forgot password?</a>
            <input type="submit" value="Login" id='login' name="login" class="btn">
            <a href="Signup.php" class="create-account">Create account</a>
            <a href="index.php"> <i class='bx bx-arrow-back'></i>Back</a>
        </form>
    </div>
</body>
</html>
<!-- 
<script>
    $("document").ready(function(){
        $("#login").click(function(e){
            e.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();
            $.ajax({
                url :  "signupController/LoginUser.php",
                method  : "POST",
                data : {
                    username  : username,
                    password  : password 
                },
                success : function(response){
                    aler(response);
                }
            })
        })
    })
</script> -->