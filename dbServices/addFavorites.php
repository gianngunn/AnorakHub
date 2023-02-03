<?php
session_start();
    require '../vendor/autoload.php';
    $m = new MongoDB\Client ("mongodb://127.0.0.1/");
    $db = $m->AnorakHub;
    $collection = $db->users;
    $pCode = $_GET['pCode'];

    $checkFav = $collection->find(["favoriteItems" => $pCode]);
    $cursor = $collection->find();

    if($checkFav-> isDead()){
       $collection->updateOne(['uemail'=>$_SESSION['uemail']],['$push'=> ['favoriteItems'=>$pCode]]);
        header('Location:../singleProduct.php?pCode=<?=$pCode?>');
}else{
?><script>
//thelei ftiajimo design
alert('favorite exists')
window.location.replace('../singleProduct.php?pCode=<?=$pCode?>');
</script><?php 
    }


?>