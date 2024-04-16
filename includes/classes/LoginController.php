<?php
session_start();
class LoginController extends Dbh
{
    private $uid;
    private $pwd;

    public function __construct($uid,$pwd){
        $this->uid = $uid;
        $this->pwd = $pwd;  
    }

    private function emptyInput(){
        $result;
        if(empty($this->uid) || empty($this->pwd)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function getUser($uid,$pwd){
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE user_name = ? OR email = ? AND pwd=?");
            $stmt->execute(array($uid,$uid,$pwd));
            $row = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row > 0){
                if($row['is_admin']){
                    $_SESSION['user_admin'] = $row['user_name'];
                    $_SESSION['is_admin'] = $row['is_admin'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['admin_id'] = $row['user_id'];

                    header("location:../admin/admin.php?admin=$row[user_name]");
                }else{
                    $_SESSION['user'] = $row['user_name'];
                    $_SESSION['address'] = $row['address'];
                    
                    header("location:../user/user.php?$row[user_name]");
                }
            }else{
                header("location:/project/Iv/login.php?error=Incorrect password or email");
                exit();
            }
            if($this->emptyInput() == false){
                header("login.php?error=Empty Fields");
            }
           

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   


}



