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
    if($document != ''){
        array_push($orderdItems,$document);
    }
    
};

$sum = 0;
$collection = $db->products;
foreach ($cartItems[0] as $item){
    $pCursor=$collection->find(['productCode'=>$item]);
    foreach ($pCursor as $document) { 
        $pStock = $document['stock'];
        $nStock = $pStock - 1;
        $stock = $nStock;
        $collection->updateOne(['productCode'=>$item], ['$set'=> ['stock'=>$stock]]);
        $price = $document['price'];
        $sum += $price;
    };
};
    $orderNum = 0;

    $collection=$db->orders;
    $orderN=$collection->find(['orderNumber'=>$orderNum]);
    
    while (!$orderN->isDead()){
        $orderNum = rand(0,99999999999999999);
        $orderN = $collection->find(['orderNumber'=>$orderNum]);
    }
    
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
    $orderStatus = "active";
    $orderNumber = $orderNum;

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
        "totalPrice"=>$totalPrice,
        "orderStatus"=>$orderStatus,
        "orderNumber"=>$orderNumber
    );
    $collection=$db->orders;
    $collection->insertOne($document);
    
    $collection=$db->users;
    $user= $collection->find(['uemail'=>$uemail]);
    $bought=array();
    foreach($user as $document){
        #if($document['hasBought']!=' ')
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
alert('i paraggelia kataxorithike');
window.location.replace('../index.php');
</script>
<?php 
?>