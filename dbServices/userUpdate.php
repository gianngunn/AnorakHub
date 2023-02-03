<?php
    
    require '../vendor/autoload.php';

    $m = new MongoDB\Client ("mongodb://127.0.0.1/");

    $db = $m->AnorakHub;
    $collection = $db->users;

    $uemail = $_GET['uemail'];
    $cursor = $collection->find(array('uemail' => $uemail));
    $myArr = array();
   

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];  
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    $cursor=$collection->updateOne(['uemail'=>$uemail],
	['$set'=>
		['firstName'=> $firstName,
		'lastName'=> $lastName,
		'phone'=> $phone,
        'age' => $age,
		'address'=> $address,
		'city'=> $city,
		'zip'=> $zip
		]
	]);
    #foreach($cursor as $x){
     #   echo "$x ";
    #}
    header("Location: ../myAccount.php?uemail=$uemail");

#logika tha enosoume auto edw myAccount
?>