<?php
session_start();

require '../vendor/autoload.php';
$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->orders;
$productColl = $db->products;
$orderNumber=(int)$_GET['orderNumber'];
$cancelled="cancelled";
$cursor=$collection->find(['orderNumber'=> $orderNumber]);
#print_r($cursor);
if (!$cursor->isDead()){
    foreach($cursor as $document){
        if($document['orderStatus']=="active" && $document['orderNumber']==$orderNumber){
            $msg = "Order cancelled";
            $collection->updateOne(['orderNumber'=>$orderNumber], ['$set'=> ['orderStatus'=>$cancelled]]);
            $ord=$collection->find(['orderNumber'=> $orderNumber]);
            $parray = array();
            foreach($ord as $doc){
                array_push($parray,$doc['productsBought']);
            }
            
            foreach($parray[0] as $prod){
                $product=$productColl->find(['productCode'=>$prod]);
                foreach($product as $d){
                    $pStock = $d['stock'];
                    $nStock = $pStock + 1;
                    $stock = $nStock;
                    $productColl->updateOne(['productCode'=>$prod], ['$set'=> ['stock'=>$stock]]);
                }
            }
           echo "<script>if(confirm('$msg')){document.location.href='../myOrdersPage.php'};</script>";
        }else{
            $msg="Order is allready cancelled";
            echo "<script>if(confirm('$msg')){document.location.href='../myOrdersPage.php'};</script>";
        }
    }
}else{
    $msg="No order found";
    echo "<script>if(confirm('$msg')){document.location.href='../myOrdersPage.php'};</script>";
}
?>