<!-- gia to header edw thelei ../ gia tis sundeseis na doule4oun
mporoume na to bgaloume apo to components an einai-->
<?php
session_start();
    //function displayProduct(){
       include 'components/header.php';
       require 'vendor/autoload.php';
       include 'components/searchModal.php';
       include 'components/loginModal.php';
       include 'components/signupModal.php';

    $m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;

$pCode = $_GET['pCode'];
$cursor = $collection->find(array('productCode' => $pCode));

#$myArr= array();

foreach ($cursor as $document) { 
        $name = $document["name"]; 
        $price = $document["price"];
        $stock = $document["stock"];
        $description = $document["description"];
        $image = $document["image"];
        $rating = $document["rating"];
    }
   
    ?>
<section id="productSection">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="img/<?=$image?>" alt="..." />
            </div>
            <div class="col-md-6" id="productInfo">
                <!--Product Code-->
                <div class="mb-2">
                    productCode: <span id="pCode" value=""><?=$pCode?></span>
                </div>
                <!--Product Name-->
                <h3 class="display-5 fw-bolder mb-2" id="pName">
                    <?=$name?>
                </h3>
                <h5 class="my-3" id="rating">
                    <span> Rating: <?=$rating?> /5
                    </span>
                </h5>
                <!--Product Price-->
                <h5 class="my-3" id="pprice">
                    <span><?=$price?> €
                    </span>
                </h5>
                <!--Product Description-->
                <p class="mb-4" id="productDesc"><?=$description?></p>
                <!--Product favorite-->
                <?php

                if (isset($_SESSION['uemail'])){ 
                    #find gia ta favorites   
                    ?><a href="dbServices/addFavorites.php?pCode=<?=$pCode?>" class="btn btn-primary">Add to
                    favorite</a>
                <a href="dbServices/addToCart.php?pCode=<?=$pCode?>" class="btn btn-primary">Add to cart</a>
                <?php
                }else{
                    ?>
                <p>*login or signup to buy or add to favorites*</p>
                <?php
                }?>

            </div>
        </div>
    </div>
</section>
<!--Reviews-->
<?php
$collection = $db->reviews;

$cursor = $collection->find();
?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-12">
            <h1 class="text-center">Ratings and Reviews</h1>
            <br><br>
            <div class="row">
                <div class="col-12">
                    <?php
                    $x=0;
foreach($cursor as $document){
    if($pCode == $document["pCode"]){
        $uemail = $document["uemail"];
        $rating = $document["rating"];
        $pReview = $document["pReview"];
        $x++;
    #an x = 0 print no reviews
        ?>

                    <ul>
                        <li class="submitted-review">
                            <p><strong><?=$uemail?></strong></p>
                            <p>Rating : <strong><?=$rating?></strong></P>
                            <p>Comments : <strong><?=$pReview?></strong></p>
                        </li>
                    </ul>
                    <?php


    }
}
if($x==0){
    ?>
                    <p>No reviews and ratings yet</p>
                    <?php
}
?>
                </div>
            </div>
            <!--Make a review-->

        </div>
        <?php 
    if (isset($_SESSION['uemail'])){
        $collection = $db->users;
        $uemail = $_SESSION['uemail'];
        #$cursor = $collection->find(array('uemail' => $uemail));
        $cursor = $collection->find(array('hasBought' =>$pCode));#den jerw an tsekarei olo to array alla logika to kanei afou douleuei
        $x=0;
        foreach($cursor as $document){
            if($document['uemail']==$uemail){
                $x=$pCode;
            }
        } #den jerw ti ekana alla douleuei mallon
        if($x == $pCode){ 
            ?>

        <div class="col-12 mt-4">
            <form action="dbServices/addReviews.php?pCode=<?=$pCode?>" method="post">
                <h2 class="text-center">Add your review</h2>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="inputEmail3" class="col-form-label">Email</label>
                        <input type="email" class="form-control" disabled name="inputEmail3"
                            value='<?=$_SESSION['uemail']?>' required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="inputReview" class="col-form-label">Review</label>
                        <!--text area--> <input type="text" class="form-control" name="inputReview" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="quantity" class="col-form-label">Rating</label>
                        <input type="number" id="quantity" class="form-control" name="quantity" min="0" max="5"
                            placeholder="0 to 5" required>
                    </div>
                </div>
                <!-- <fieldset class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Rating: </label>
                    <div class="col-sm-10">
                        <input type="number" id="quantity" class="form-control" name="quantity" min="0" max="5"
                            placeholder="0 to 5" required>
                    </div>
                </fieldset> -->

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
    }else{
        ?>
        <p>buy the product to review it</p>
        <?php
    }
    
    }
    
   
?>
    </div>
</div>
<?php 
//};
    include 'components/footer.php';

?>