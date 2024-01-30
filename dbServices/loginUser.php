<?php
session_start();

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;

if (isset($_POST['uemail']) && isset($_POST['password'])){
	$uemail = $_POST['uemail'];
	$password = $_POST['password'];
	$cursor = $collection->find(array("uemail" => $uemail));
	if (!$cursor->isDead()){
		foreach ($cursor as $document){
			$pass=$document['password'];
			if ($pass == $password){
				$_SESSION['uemail'] = $uemail;
                header("Location:../index.php");
				
			}else {
				$msg="Wrong Password!!";
    			echo "<script>if(confirm('$msg')){document.location.href='../index.php'};</script>";
				
			}
		}
	}else {
		$msg="user not found!!";
    	echo "<script>if(confirm('$msg')){document.location.href='../index.php'};</script>";
				
	}
	
}

?>