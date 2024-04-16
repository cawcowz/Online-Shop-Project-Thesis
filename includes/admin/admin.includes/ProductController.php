
<?php
require_once 'AdminDb.php';
class ProductController extends Db{

    public function viewData(){
        $query = "SELECT * FROM inventory_table ORDER BY sold DESC";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function searchData($name){
        $query = "SELECT * FROM inventory_table WHERE product_name= :name OR product_code = :code OR category = :category";

        $stmt = $this->connect()->prepare($query);

        $stmt->execute(array(':name'=>$name,":code"=>$name, ":category"=>$name));

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function orders(){
        $query = "SELECT * FROM orders  ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function showAllOrders($uid){
        $query = "SELECT * FROM orders WHERE username = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($uid));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function deleteOrder($uid){
        $query = "DELETE  FROM orders WHERE username = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($uid));
        return $stmt;
    }
    public function getAdress($uid){
        $query = "SELECT address , phone_no , email FROM users WHERE user_name = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($uid));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getUserImg($uid){
        $query = "SELECT img FROM users WHERE user_name = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($uid));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // For Accepting orders 
    public function acceptOders($fn,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status,$uniqid){
        $query = "INSERT INTO ship(Full_name,address,order_id,product_name,quantity,total,img,user_id, status,uniqid) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($fn,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status,$uniqid));
        return $stmt;
    }
    public function notify($fullname,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status){
        $query = "INSERT INTO notification(Fullname,address,order_id,product_name,quantity,total,img,user_id,status) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($fullname,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status));
        return $stmt;
    }
    public function toShip($name,$address,$order_id,$product_name,$quantity,$price,$img,$user_id,$uniqid,$status){
        $query = "INSERT INTO toreceive(Full_name,address,order_id,product_name,quantity,total,img,user_id,uniqid,status) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($name,$address,$order_id,$product_name,$quantity,$price,$img,$user_id,$uniqid,$status));
        return $stmt;
    }
    public function ShowtoShip(){
        $query = "SELECT * FROM ship";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function ViewShip($order_id){
        $query = "SELECT * FROM ship WHERE order_id =?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($order_id));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function ViewOrders($order_id){
        $query = "SELECT * FROM orders WHERE order_id =?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($order_id));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function ViewToReceive($order_id){
        $query = "SELECT * FROM toreceive WHERE order_id =?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($order_id));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    // To receive
    public function toReceive($fn,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status){
        $query = "INSERT INTO toreceive(Full_name,address,order_id,product_name,quantity,total,img,user_id,status) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($fn,$address,$order_id,$product_name,$quantity,$total,$img,$user_id,$status));
        return $stmt;
    }

    public function removeDataFromOrder($order_id){
        $query = "DELETE FROM orders WHERE order_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($order_id));
        return $stmt;
    }
    public function remove($uniqid){
        $queryRemove = "DELETE FROM orders WHERE uniqid = ?";
        $stmtRemove = $this->connect()->prepare($queryRemove);
        $stmtRemove->execute(array($uniqid));
        return $stmtRemove;
    }
    public function removeDataFromShip($order_id){
        $query = "DELETE FROM ship WHERE uniqid = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($order_id));
        return $stmt;
    }

    public function toReceive2($order_id){
        $query = "SELECT * FROM ship WHERE order_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($order_id));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // Show To Receive
    public function showToReceive(){
        $query = "SELECT * FROM toreceive ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function TrackingNum($order_id){
        $status = "toship";
        $query ="INSERT INTO tracking (track_no, status) VALUES (?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($order_id, $status));
        return $stmt;
    }
    public function UpdateTrack($uniqid){
        $status = "toreceive";
        $query = "UPDATE tracking SET status = ? WHERE track_no = ?" ;
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($status,$uniqid));
        return $stmt;
    }

    // REcords
    public function DisplayRecords(){
        $query = "SELECT * FROM records ORDER BY id DESC";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // Inventory History
    public function ViewInventoryHistory(){
        $query = "SELECT * FROM inventory_history ORDER BY id DESC";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // Evaluate stocks
    public function updateStock($quantity,$product_name){
        $query = "SELECT stocks FROM inventory_table WHERE product_name = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($product_name));
        $datas = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            $newStock =  $datas['stocks'] - $_SESSION['quantity'];
            $query = "UPDATE inventory_table SET stocks = ? WHERE product_name = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($newStock,$product_name));
        }

    }
    public function updateSold($quantity,$product_name){
        $query = "SELECT sold FROM inventory_table WHERE product_name = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($product_name));
        $datas = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            $sold =  $datas['sold'] +  $quantity;
            $query = "UPDATE inventory_table SET sold = ? WHERE product_name = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($sold,$product_name));
        }

    }
}
