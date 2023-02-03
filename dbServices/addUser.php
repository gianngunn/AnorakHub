<?php
session_start();

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;#                                                mallon auto einai perito gt to tsekarei i forma
      
        $uemail = $_POST['uemail'];
        $password = $_POST['password'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $address = $_POST['address'];
        $cursor = $collection->find(array("uemail" => $uemail));
        if (!$cursor->isDead()){
            echo 'userExists';
        }else {
            $document = array (
                "uemail" => $uemail,
                "password" => $password,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "phone" => $phone,
                "address" => $address,
                "city" => $city,
                "zip" => $zip,
                "cartItems"=>[""],
                "favoriteItems"=>[""],
                "hasBought"=>[""],
                "age"=>$age
            );	
            $collection->insertOne($document);
            
            header('Location:../editUsersPage.php');
        }  
    
   
    
	

?>