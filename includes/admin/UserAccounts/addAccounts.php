<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container mx-auto md:w-4/12 border p-2">
        <a href="../Settings.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class='text-lg text-center'>Add New Account</h1>
        <hr><br>
        <div class='w-full flex flex-col'>
            <input type="text" class='px-2 py-1 mb-2' id='username' placeholder ='Username'>
            <input type="text" class='px-2 py-1 mb-2' id='email' placeholder ='Email'>
            <input type="text" class='px-2 py-1 mb-2' id='password' placeholder ='Password'>
            <input type="text" class='px-2 py-1 mb-2' id='confirm_password' placeholder ='Confirm password'>
            <label for="">Account type:</label>
            <select name="" id="account_type" class='border p-2'>
                <option id='user' value="">User</option>
                <option id='admin' value="is_admin">Admin</option>
            </select>
            <div class='text-sm text-red-500 mb-5'id='err'></div>
            <button id='create' class='bg-red-700 text-white px-2 py-1 hover:bg-red-600 duration-300 rounded-sm'>Create</button>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#create").click(function(){
            var username = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirm_password = $("#confirm_password").val();
            var account_type = $("#account_type").val();
            $.ajax({
                url : "addController.php",
                method : "POST",
                data : {
                    username : username,
                    email : email,
                    password : password,
                    confirm_password : confirm_password,
                    account_type : account_type
                },
                success : function(response){
                    if(response == "Successfully added"){
                        alert(response);
                        window.location.reload();
                        $(window).attr('location','../Settings.php')
                    }else{
                        $("#err").html(response);
             
                    }
                }
            })
        })
    })
</script>