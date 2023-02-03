<?php
#elenxos ean uparxei idi review apo ton idio xristi?
require '../vendor/autoload.php';
    $m = new MongoDB\Client ("mongodb://127.0.0.1/");
    $db = $m->AnorakHub;
    $collection = $db->reviews;
    $pCode = $_GET['pCode'];
    if(isset($_POST['inputEmail3']) && isset($_POST['inputReview']) && isset($_POST['quantity'])){
        $uemail = $_POST['inputEmail3'];#thelei elenxo gia to email
        $pReview = $_POST['inputReview'];
        $rating = (double)$_POST['quantity'];

        $document = array(
            "pCode" => $pCode,
            "rating" => $rating,
            "pReview" => $pReview,
            "uemail" => $uemail
        );
        $collection->insertOne($document);

        $reviewsCursor = $collection->find();
        $ratingR=0;
        $i=0;
        foreach($reviewsCursor as $document){
            if($pCode == $document['pCode']){
                $ratingR = $ratingR + $document['rating'];
                $i++;
            }
        };
        #$ratingR = a;
        if(($i>0) && ($ratingR>0)){
            $ratingR = $ratingR/$i;
            
            $collection = $db->products;
          
            $collection->updateOne(['productCode' => $pCode],
            ['$set' => ['rating' => $ratingR]]);
        }
        
    

    }
    header("Location: ./singleProduct.php?pCode=$pCode");
?>