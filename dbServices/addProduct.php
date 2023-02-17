<?php
session_start();

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;#                                                mallon auto einai perito gt to tsekarei i forma
      
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $productIs = $_POST['productIs'];
        $productCode = $_POST['productCode'];
        
        $cursor = $collection->find(array("productCode" => $productCode));
        if (!$cursor->isDead()){
            echo 'productExists';
        }else {
            $document = array (
                "name" => $name,
                "price" => $price,
                "stock" => $stock,
                "description" => $description,
                "productIs" => $productIs,
                "address" => $address, #afairesi logika
                "productCode" => $productCode,
                "rating"=>0,
                "image"=>$image
            );	
            $collection->insertOne($document);
            
            header('Location:../editProductPage.php');
        }  
    
   
    
	

?>
