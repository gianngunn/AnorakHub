<?php

require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;


$cursor = $collection->find();

$myArr= array();

foreach ($cursor as $document) { 
	if($document["productIs"] == "cigar")
    // {array_push($myArr,
	// array(
	// 	"name"=>$document["name"],
	// 	"price"=>$document["price"],
	// 	"stock"=>$document["stock"],
	// 	"description"=>$document["description"],
	// 	"image"=>$document["image"],
    //     "productIs"=>$document["productIs"]
	// ));}
    $name = $document["name"];
    $price = $document["price"];

    $stock = $document["stock"];?>
<div>
    <h1><?php echo $name?></h1>
</div><?php
}

//return $myArr;
// echo json_encode($myArr);
echo $name;

exit;

?>