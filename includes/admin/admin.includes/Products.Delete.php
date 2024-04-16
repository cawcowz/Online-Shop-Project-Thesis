
<?php
try{
    $id = $_GET['id'];
    $db = new PDO("mysql:host=localhost;dbname=inventory_system","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "DELETE FROM inventory_table WHERE Id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($id));
    header("location: ../Products.php");
}catch(PDOException $e){
    echo $e->getMessage();

}

