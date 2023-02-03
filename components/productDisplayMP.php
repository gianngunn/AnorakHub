<?php
    function populateProductsMP(){
    
        require './vendor/autoload.php';
    $m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;


$cursor = $collection->find();

$myArr= array();

foreach ($cursor as $document) { 
	
        $name = $document["name"];
        $price = $document["price"];
        $stock = $document["stock"];
        $description = $document["description"];
        $image = $document["image"];
        $productCode = $document["productCode"];
        #$rating = $document["rating"]
   
    ?>
<div class="col-4 mt-4">

    <div class="card text-center" style="width: 18rem;">
        <img src="./img/<?=$image?>" class="card-img-top border-bottom" alt="...">
        <div class="card-body bg-light">
            <h5 class="card-title"><?=$name?></h5>
            <p class="card-text">Test test test</p>
            <a href="singleProduct.php?pCode=<?=$productCode?>" class="btn btn-primary">Details</a>
        </div>
    </div>
</div>
<?php 
}
};

?>






<!--<div class="card-deck">
    <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
    <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
    <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content. This card has even longer content than the first to show that equal height action.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>
</div>-->