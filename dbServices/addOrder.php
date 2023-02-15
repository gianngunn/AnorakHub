<?php 
require '../vendor/autoload.php';
$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;
$user= $collection->find(['uemail'=>$_POST['uemail']]);
$cartItems = array();
foreach($user as $document){
    array_push($cartItems, $document['cartItems']);
};
$orderdItems = array();
foreach($cartItems[0] as $document){
    array_push($orderdItems,$document);
};
$sum = 0;
$collection = $db->products;
foreach ($cartItems[0] as $item){
    $pCursor=$collection->find(['productCode'=>$item]);
    foreach ($pCursor as $document) { 
        $price = $document['price'];
        $sum += $price;
    };
};
    $uemail = $_POST['uemail'];
    $ufname = $_POST['firstName'];
    $ulname = $_POST['lastName'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $orderDate = date("Y/m/d");
    $products = $orderdItems;
    $totalPrice = $sum;

    $document = array(
        "uemail"=>$uemail,
        "ufname"=>$ufname,
        "ulname"=>$ulname,
        "phone"=>$phone,
        "city"=>$city,
        "address"=>$address,
        "zip"=>$zip,
        "orderDate"=>$orderDate,
        "productsBought"=>$products,
        "totalPrice"=>$totalPrice
    );
    $collection=$db->orders;
    $collection->insertOne($document);
    
    $collection=$db->users;
    $user= $collection->find(['uemail'=>$uemail]);
    $bought=array();
    foreach($user as $document){
        array_push($bought, $document['hasBought']);
    };
    foreach($cartItems[0] as $ci){
        $key=0;
        foreach($bought[0] as $bi){
            if($ci == $bi){
                $key=1;
            }         
        };
        if($key==0){
            $collection->updateOne(['uemail'=>$uemail],['$push'=>['hasBought'=>$ci]]);
        }
    };
    
    $collection->updateOne(['uemail'=>$uemail],['$set'=>['cartItems'=>['']]]);
    ?><script>
//thelei ftiajimo design
alert('i paraggelia kataxorithike')
window.location.replace('../index.php');
</script><?php 
?>