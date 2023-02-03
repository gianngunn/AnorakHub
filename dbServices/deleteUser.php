<?php
session_start();

require '../vendor/autoload.php';
$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;
$uemail=$_GET['uemail'];
if($_SESSION['isAdmin']=='yes'){
    $collection->deleteOne(['uemail'=>$uemail]);
}
header('Location: ../editUsersPage.php')
?>