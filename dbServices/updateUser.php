<?php
session_start();

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;#                                                mallon auto einai perito gt to tsekarei i forma

if (isset($_SESSION['isAdmin']) == 'yes'){
	
       
        $uemail = $_POST['uemail'];
        $password = $_POST['password'];
        $cursor = $collection->find(array("uemail" => $uemail));
        
        $cursor = $collection->updateOne(['userID'=>$userID],
        ['$set'=>
            ['firstName'=> $firstName,
            'lastName'=> $lastName,
            'phone'=> $phone,
            'address'=> $address,
            'city'=> $city,
            'zip'=> $zip,
            'age'=> $age
            ]
        ]);
    
header();
        

    
    }   
    
	

?>