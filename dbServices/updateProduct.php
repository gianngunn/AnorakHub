<?php
session_start();

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;#                                                mallon auto einai perito gt to tsekarei i forma

if (isset($_SESSION['isAdmin']) == 'yes'){
	
       
        $productCode = $_GET['productCode'];
        
        
        
        $cursor = $collection->updateOne(['productCode'=>$productCode],
        ['$set'=>
            ['name'=> $_POST['name'],
            'price'=> $_POST['price'],
            'stock'=> $_POST['stock'],
            'description'=> $_POST['description'],
            'image'=> $_POST['image'],
            'productIs'=> $_POST['productIs']
            ]
        ]);
    
header('Location: ../editProductPage.php');
        

    
    }   
    
	

?>