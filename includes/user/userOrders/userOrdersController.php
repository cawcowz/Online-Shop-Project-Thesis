<?php 
include_once '../productDesController.php';
class UserOrdersController extends Cart
{
    public function myOrder($user_id){
        $query = "SELECT * FROM ship WHERE user_id = ?";
        $stmt =  $this->Database()->prepare($query);
        $stmt->execute(array($user_id));
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function outForDelivery($user_id){
        $query = "SELECT * FROM toreceive WHERE user_id = ?";
        $stmt =  $this->Database()->prepare($query);
        $stmt->execute(array($user_id));
        // $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }
    public function OrderReceive( $pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$status,$uniqid){
        $query = 'INSERT INTO torate(product_name,Full_name,address,order_id,quantity,total,img,user_id,status,uniqid,action) VALUES ( ?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $this->Database()->prepare($query);
        $stmt->execute(array($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$status,$uniqid,"Delivered"));  
        // $query = "SELECT * FROM torate WHERE action = ?";
        // $stmt = $this->Database()->prepare($query);
        // $stmt->execute(array('Delivered'));
        // $stmtshow = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //     if($stmt->rowCount() > 0 ){
        //         $query = "DELETE FROM torecive";
        //     }
        return $stmt;
    }
    public function deleteOrder($uniqid){
        $query = "DELETE FROM `toreceive` WHERE uniqid = ?";
        $stmt = $this->Database()->prepare($query);
        $stmt->execute(array($uniqid));
        return $stmt;
    }
    public function Delivered($uniqid){
        $querySelect = "SELECT * FROM toreceive WHERE uniqid = ?";
        $stmtSelect = $this->Database()->prepare($querySelect);
        $stmtSelect->execute(array($uniqid));
        $show = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
        foreach($show as $show){
            $query =  $queryInsertRecord = "INSERT INTO records (Full_name,address,product_name,order_id,quantity,total,img,user_id,status,uniqid,action) VALUES(?,?,?,?,?,?,?,?,?,?,?) ";
            $stmt = $this->Database()->prepare($query);
            $stmt->execute(array($show['Full_name'],$show['address'],$show['product_name'],$show['order_id'],$show['quantity'],$show['total'],$show['img'],$show['user_id'],$show['status'],$show['uniqid'],"Delivered"));
        }
        return $stmtSelect;
    }
    public function rate($user_id){
        $query = "SELECT * FROM torate WHERE user_id = ?";
        $stmt =  $this->Database()->prepare($query);
        $stmt->execute(array($user_id));
        return $stmt;
    }
    public function addHistory($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$status,$uniqid){
        $query = "INSERT INTO history (product_name,Full_name,address,order_id,quantity,total,img,user_id, uniqid,status) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->Database()->prepare($query);
        $stmt->execute(array($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$uniqid,"Delivered"));
        return $stmt;
    }
    public function Return($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$status,$uniqid){
        $query = "INSERT INTO history (product_name,Full_name,address,order_id,quantity,total,img,user_id, uniqid,status) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->Database()->prepare($query);
        $stmt->execute(array($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$uniqid,"Return"));
        return $stmt;
    }
    public function returnAddToRecords($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$status,$uniqid){
        $query = "INSERT INTO records (product_name,Full_name,address,order_id,quantity,total,img,user_id, uniqid,status,action) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->Database()->prepare($query);
        $stmt->execute(array($pn, $fn,$address,$order_id,$quantity,$total,$img,$user_id,$uniqid,"Return","Return"));
        return $stmt;
    }
    public function insertToSales($fn,$address,$produvt_name,$order_id,$total,$quantity){
        $querySales = "INSERT INTO sales (Full_name,address,product_name,order_id,total,quantity) VALUES(?,?,?,?,?,?)";
        $stmtSales = $this->Database()->prepare($querySales);
        $stmtSales->execute(array($fn,$address,$produvt_name,$order_id,$total,$quantity));
        return $stmtSales;
    }
    public function updateSold($pn,$qnt){
        $querySales = "SELECT sold from inventory_table where product_name = ?";
        $stmtSales = $this->Database()->prepare($querySales);
        $stmtSales->execute(array($pn));
        $datas  = $stmtSales->fetchAll(PDO::FETCH_ASSOC);
        if($stmtSales->rowCount() > 0){
            foreach($datas as $data){
                $queryUpdate = "UPDATE inventory_table SET sold = ? WHERE product_name = ?";
                $stmt= $this->Database()->prepare($queryUpdate);
                $stmt->execute(array($data['sold'] + $qnt, $pn));
                return $stmt;
            }
        }
        
    }
}