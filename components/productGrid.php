<?php
    function populateProducts($category){
    
        require './vendor/autoload.php';

    $m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;


$cursor = $collection->find();

$myArr= array();

foreach ($cursor as $document) { 
	if($document["productIs"] == $category) {
        $name = $document["name"];
        $price = $document["price"];
        $stock = $document["stock"];
        $description = $document["description"];
        $image = $document["image"];
        $productCode = $document["productCode"];
        $rating = $document["rating"];


   ?>
<div class="col-4 mt-4">

    <div class="card text-center" style="width: 18rem;">
        <img src="./img/<?=$image?>" class="card-img-top border-bottom" alt="...">
        <div class="card-body bg-light">
            <h5 class="card-title"><?=$name?></h5>
            <p class="card-text">Rating: <?=$rating?>/5</p>
            <p class="card-text">Stock: <?=$stock?></p>
            <a href="singleProduct.php?pCode=<?=$productCode?>" class="btn btn-primary">Details</a>
        </div>
    </div>
</div>
<?php
}
   
    ?>

<?php 
}
};

?>