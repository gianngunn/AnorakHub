<?php
session_start();

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;#                                                mallon auto einai perito gt to tsekarei i forma

if (isset($_POST['uemail']) && isset($_POST['password']) && isset($_POST['password-repeat'])){
	if ($_POST['password'] == $_POST['password-repeat']){
       
        $uemail = $_POST['uemail'];
        $password = $_POST['password'];
        $cursor = $collection->find(array("uemail" => $uemail));
        if (!$cursor->isDead()){
            echo 'userExists';
        }else {
            $document = array (
                "uemail" => $uemail,
                "password" => $password,
                "firstName" => " ",
                "lastName" => " ",
                "phone" => " ",
                "address" => " ",
                "city" => " ",
                "zip" => " ",
                "cartItems"=>[""],
                "favoriteItems"=>[""],
                "hasBought"=>[""],
                "age"=>" "
            );	
            $collection->insertOne($document);
            $_SESSION['uemail'] = $uemail;
            $_SESSION['password'] = $password;
            header('Location:../index.php');
        }  
    } else {
        echo"password not the same";
    }   
    
	
}
?>