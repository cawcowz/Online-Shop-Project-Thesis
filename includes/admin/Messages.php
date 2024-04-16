<?php
session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=inventory_system',"root","");
    $query = "SELECT * FROM users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $name = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script> 

<!-- <link rel="stylesheet" href="style.css"> -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
      <!-- Jquery / Ajax -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
</head>
<body>
<title>Products</title>
<?php include_once 'Header.php';?>
    <div class="container flex justify-center p-2">
        <!-- Box -->
        <div class='w-9/12 h-[690px] border border-sky-500 flex bg-gray-100  shadow-lg rounded-lg'>
            <!-- Left side -->
            <div class='w-[200px] border-2 bg-gray-900  overflow-y-auto py-10'>
                <?php foreach($datas as $data){
                    if($data['is_admin']== ""){?>
                    <a class='bg-blue-100/40 hover:bg-blue-100/50 w-full p-2 text-center flex items-center mt-1' href="Messenger/Receiver.php?receiver=<?php echo $data['Full_name']?>&img=<?php echo $data['img']?>">
                    <span class='ml-2 text-sm'><?php echo $data['user_name']?> </span>
                    </a> 
                <?php }}?>
            </div>
            <!-- Left side End-->
            <!-- Right Side -->
            <div class='w-full py-2'>
                <div class='w-full border-b border-gray-900 h-[100px]  flex items-center'>
                    <?php if(isset($_SESSION['receiver'])){?>
                        <img src="../User/UserSettings/ProfilePicture/<?php echo $_SESSION['img'];?>" alt="" class='border border-gray-900 shadow-lg md:w-[60px] md:h-[60px] w-[50px] h-[50px] rounded-full shadow-lg'>
                        <input type="text" id="receiver"class='bg-transparent' value="<?php echo $_SESSION['receiver']?>" readonly>
                   <?php }else{
                        return false;
                    }
                    ?>           
                </div>
                <div class='bg-white h-[580px] border flex flex-col justify-between'>
                    <div id="messageSection" class='p-2 overflow-y-auto'>
                        <!-- <h1>hey</h1> -->
                    </div>
                    <div class='pb-2 w-full flex justify-between px-2 '>
                        <input id="inputMessage" type="text" class='inputMessage  bg-gray-100 p-2 text-sm rounded-lg border-gray-100 w-full' placeholder="write message.. ">
                        <button id="btnSend" class='mx-3 hover:scale-105 duration-300'><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
   
            </div>
            <!-- Right Side -->

        </div>
        <!-- Box end -->

    </div>

  
    
    <script>
        $(document).ready(function(){
            $("#btnSend").click(function(){
                var  inputMessage = $(".inputMessage").val();
                if(inputMessage != ""){
                    $.ajax({
                        url     : "Messenger/sendMessages.php",
                        method  : "POST",
                        data    : {
                            sendMessage : inputMessage
                        },
                        success   : function(response){
                            var  inputMessage = $(".inputMessage").val("");
                            $("#messageSection").html(response);
                        }
                    })

                }
            })
            setInterval(()=>{
                $("#messageSection").load("Messenger/displayMessage.php");
            },1000);
        });
    </script>

</body>
</html>