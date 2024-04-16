
<?php
if(isset($_POST['login'])){
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    // Instantiate Controller Class
    include_once 'db.php';
    include_once 'LoginController.php';

    $login = new LoginController($uid,$pwd);
    $login->getUser($uid,$pwd);
}
?>
