<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'components/header.php';
  require 'components/loginModal.php';
  require 'components/signupModal.php';
  require 'components/searchModal.php';
  require 'vendor/autoload.php';

  $m = new MongoDB\Client ("mongodb://127.0.0.1/");
  $db = $m->AnorakHub;
  $collection = $db->users;
  $uemail = $_SESSION['uemail'];
 
  $fav = $collection->find(["uemail"=>$uemail]);
 
  $f = 0;
  $pArray = array();
  
  $finalAr = array();
  $fml=array();

 # foreach($fav as $document){
  #      array_push($pArray,$document['favoriteItems']);
  #      $f=1;
 #};

 #print_r($fav);

 foreach($fav as $doc){
    array_push($pArray,$doc['favoriteItems']);
    
    $f=1;
 };
 #$x=$pArray;
  #print_r($x);
    
  


  if($f==1){
    $collection = $db->products;
    $pCursor = $collection->find();
  }
  foreach($pCursor as $doc){
    
    array_push($fml,$doc['productCode']);
    
 };
#print_r(sizeof($fml));
?>

<body id="favoritesPage">
    <?php
if($f==1){
   ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">image</th>
                <th scope="col">product code</th>
                <th scope="col">name</th>
                <th scope="col">price</th>

            </tr>
        </thead>
        <tbody>

            <?php 
            #print_r($pArray[0][1]);
                $xi = sizeof($fml);
                $ti = sizeof($pArray[0]);
                for($i=0; $i<$xi; $i++){ 
                    $ye = $fml[$i];
                    #print_r($ye);
                    for($j=0; $j<$ti; $j++){
                        if($ye == $pArray[0][$j]){
                           
                           # print_r($ye);
                           $product = $collection->find(["productCode" => $ye]);
                           #print_r($product); 
                           foreach($product as $tet){
                            array_push($finalAr,
                            array(
                            "image"=>$tet["image"],
                            "productCode"=>$tet["productCode"],
                            "name"=>$tet["name"],
                            "price"=>$tet["price"]));
                           };
                           
                        }
                    }
                 };
                 #print_r($finalAr) ;
                 foreach($finalAr as $document){
                ?>
            <tr>
                <td><img src="img/<?=$document["image"]?>" width="100" height="100"></td>
                <td><?=$document["productCode"]?></td>
                <td><?=$document["name"]?></td>
                <td><?=$document["price"]?></td>
            </tr>
            <?php };  ?>
        </tbody>
    </table>
    <?php }
else{
    
    ?><p>No favorites</p><?php
}

?>


</body>
<?php include 'components/footer.php' ?>

</html>