<?php 
class AddressController {
   protected function Database(){
    $pdo = new PDO("mysql:host=localhost;dbname=phil_address","root","");
   }

   public function DisplayCountry(){
      $query = "SELECT * FROM country";
      $stmt = $this->Database()->prepare($query);
       $stmt->execute();
       $showCountries = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $showCountries;
   }

}