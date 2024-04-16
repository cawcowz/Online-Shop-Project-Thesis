<?php 
session_start();
    $pdo = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $query = "SELECT * FROM users";
    $stmt= $pdo->prepare($query);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include 'SettingController/settingController.php';
$settings = new AdminSettingsController();
$profilePicture= $settings->displayImg($_SESSION['admin_id']);
?>


<title>Account</title>
<?php include_once 'Header.php';?>

 <!-- Dashboard -->
 <div class="main--content">
    <!-- form -->
    <form action="" method="post"  >
        <div class="header--wrapper">
            <div class="header--title">
                <!-- <span>Primary</span> -->
                <h2 class="text-4xl">Account</h2>
            </div>
            <div class="user--info">
                <a href="AdminProfile.php?success=?" class='flex items-center'>
                    <?php foreach($profilePicture as $profile){?>
                        <img src="ProfilePicture/<?php echo $profile['img']?>" alt="">
                    <?php }?>
                    <h1 class='text-sm bg-gray-100 p-2 rounded-xl'><?php echo $_SESSION['user_admin']?></h1>
                </a>
            </div>
        </div>  
        <!-- Search Start -->
        <!-- table -->
        <div class="tabular--wrapper border  border-sky-500">
            <div class="table-container overflow-y-scroll h-[470px]">
                    <div class='w-full text-end p-2 mb-2'>
                        <a href="useraccounts/addaccounts.php" class='p-2 bg-red-800 hover:bg-red-800/90 text-white rounded-md'>Add user</a>

                    </div>
                    <table class="">
                        <thead class="bg-gray-900">
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Account type</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datas as $data) {?>
                            <tr>
                                <td><?php echo $data['user_name']?></td>
                                <td><?php echo $data['email']?></td>
                                <td><?php echo $data['is_admin']?></td>
                                <td>
                                    <a type='submit' href='UserAccounts/deleteAccount.php?id=<?php echo $data['id'] ?>'name='delete'><i class="fa-solid fa-trash-can text-red-500 text-lg"></i></a>
                                </td>
                            </tr>
                            <?php }?>
                        
        
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table end -->
        </form>
        <!-- Form end -->
    </div>

   


   
 