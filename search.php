<?php
session_start();

include 'components/header.php';
require 'components/loginModal.php';
require 'components/signupModal.php';
require 'components/searchModal.php';
require 'vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;


if(isset($_POST['searchTerm'])){
 $searchTerm=$_POST['searchTerm'];   
 $cursor = $collection->find(["name" => new \MongoDB\BSON\Regex($searchTerm,'i')]);

$myArr= array();

foreach ($cursor as $document) { 
        $name = $document["name"];
        $price = $document["price"];
        $stock = $document["stock"];
        $description = $document["description"];
        $image = $document["image"];
        $productCode = $document["productCode"];



   ?>
<div class="col-4 mt-4">

    <div class="card text-center" style="width: 18rem;">
        <img src="img/<?=$image?>" class="card-img-top border-bottom" alt="...">
        <div class="card-body bg-light">
            <h5 class="card-title"><?=$name?></h5>
            <p class="card-text">Test test test</p>
            <a href="singleProduct.php?pCode=<?=$productCode?>" class="btn btn-primary">Details</a>
        </div>
    </div>
</div>
<?php
}
   
   }else{

    ?>
<h1>no product found!</h1>

<?php 
}
include 'components/footer.php';

#$mySearch = 'coh';
#showSearchItems($mySearch)
?>