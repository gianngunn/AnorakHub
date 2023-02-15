<?php
session_start();
    require '../vendor/autoload.php';
    $m = new MongoDB\Client ("mongodb://127.0.0.1/");
    $db = $m->AnorakHub;
    $collection = $db->users;
    $pCode = $_GET['pCode'];

    $user = $collection->find(["uemail" => $_SESSION['uemail']]);
    $cursor = $collection->find();
    $cartArray = array();
    $key=0;
    foreach($user as $document){
        array_push($cartArray, $document['cartItems']);
    };
    foreach($cartArray[0] as $t){
        print_r($t);
        if($t==$pCode){
            $key=1;
        }
    };

    if($key==0){
       $collection->updateOne(['uemail'=>$_SESSION['uemail']],['$push'=> ['cartItems'=>$pCode]]);
        header("Location:../singleProduct.php?pCode=$pCode");
}else{
?><script>
//thelei ftiajimo design
alert('item exists')
window.location.replace('../singleProduct.php?pCode=<?=$pCode?>');
</script><?php 
    }


?>