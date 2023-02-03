<?php

require 'vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;


$cursor = $collection->find();

$myArr= array();

foreach ($cursor as $document) { 
	#SELECT * FROM PRODUCTS WHERE ID = '1' OR ID = '2'
	
	#SELECT * FROM PRUDCTS WHERE title LIKE '%cig'

	#$searchTerm = $_GET[$searchTerm]
	# db.products.find({"name: / $_GET[$searchTerm/})
    array_push($myArr,
	array(
		"name"=>$document["name"],
		"price"=>$document["price"],
		"stock"=>$document["stock"],
		"description"=>$document["description"],
		"image"=>$document["image"],
        "productIs"=>$document["productIs"]
	));
}

//return $myArr;
echo $myArr;

exit;

?>