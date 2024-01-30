<?php
session_start();

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;

if (isset($_SESSION['isAdmin']) == 'yes'){
	
       
        $uemail = $_GET['uemail'];
        
        
        
        $cursor = $collection->updateOne(['uemail'=>$uemail],
        ['$set'=>
            ['firstName'=> $_POST['firstName'],
            'lastName'=> $_POST['lastName'],
            'phone'=> $_POST['phone'],
            'address'=> $_POST['address'],
            'city'=> $_POST['city'],
            'zip'=> $_POST['zip'],
            'age'=> $_POST['age']
            ]
        ]);
    
        header('Location: ../editUsersPage.php');
    
    }   
?>