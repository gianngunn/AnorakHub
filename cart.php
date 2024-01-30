<?php

session_start();
require_once('components/header.php');

require 'vendor/autoload.php';
$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;

$uemail = $_GET['uemail'];
$user= $collection->find(['uemail'=>$uemail]);
$cursor= $collection->find(['uemail'=>$uemail]);
$cartItems = array();
#print_r($user);
foreach($cursor as $document){
    array_push($cartItems, $document['cartItems']);
};
#print_r($cartItems);
foreach($user as $document){
    $ufname = $document['firstName'];
    $ulname = $document['lastName'];
    $phone = $document['phone'];
    $city = $document['city'];
    $address = $document['address'];
    $zip = $document['zip'];
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- <link rel="stylesheet" href="css/about.css?v=<?php echo time(); ?>"> -->
</head>

<body>
    <div class="container my-5 pt-5">
        <div class="row my-5">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Το καλάθι σας</span>
                    <span class="badge badge-secondary badge-pill" id="cartCount"><?php 
                        if($cartItems[0][0]=="" && sizeof($cartItems[0])==1){
                            echo 0;
                        }elseif($cartItems[0][0]=="" && sizeof($cartItems[0])>1){
                            echo sizeof($cartItems[0]) - 1;
                        }
                        else{
                            echo sizeof($cartItems[0]);
                        }
                         ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
					if(sizeof($cartItems[0]) > 0){
						$sum = 0;
                        $collection = $db->products;
						foreach ($cartItems[0] as $item){
							#print_r($item);
                            
                            $pCursor=$collection->find(['productCode'=>$item]);
							
							foreach ($pCursor as $document) { 
								$name = $document['name'];
								$productCode = $document['productCode'];
								$price = $document['price'];
                                
								
//								
								echo '<li class="list-group-item d-flex justify-content-between lh-condensed listItemNubmer" value="'.$item.'">';
								echo '<div>';
									
									echo '<h5 class="my-2">'.$name.'</h5>';
                                    #document.location.href='dbServices/removeCartItem.php
									echo '<button class="btn btn-sm btn-danger removeitem" id="'.$item.'">Remove</button>';	
								echo '</div>';
								echo '<p class="text-muted">'.$price.'€</p>';
								
								echo '</li>';
								$sum += $price;
							}
						}
						echo '<li class="list-group-item d-flex justify-content-between">';
							echo '<span>Σύνολο</span>';
							echo '<strong id="totalPrice">'.$sum.'€</strong>';
						echo '</li>';
					}else { 
						echo 'Το καλάθι σας είναι άδειο αυτή τη στιγμή...<br>';

						echo '<a href="index.php"><button class="btn btn-outline-dark">Επιστροφή στο κατάστημα</button></a>';
					}
					?>


                    <!-- <li class="list-group-item d-flex justify-content-between">
						<span>Σύνολο</span>
						
					</li>-->
                </ul>
            </div>

            <div class="col-md-8 order-md-1">

                <h4 class="mb-3">Στοιχεία Χρέωσης</h4>
                <form id="submitOrder" action="dbServices/addOrder.php" method="post">

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="uemail" placeholder="" value="<?=$uemail?>"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Όνομα</label>
                            <input type="text" class="form-control" name="firstName" placeholder="" value="<?=$ufname?>"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Επώνυμο</label>
                            <input type="text" class="form-control" name="lastName" placeholder="" value="<?=$ulname?>"
                                required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Τηλέφωνο</label>
                        <input type="text" class="form-control" name="phone" placeholder="" value="<?=$phone?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="address">Διεύθυνση</label>
                        <input type="text" class="form-control" name="address" placeholder="" value="<?=$address?>"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="zip">Πόλη/Περιοχή</label>
                            <input type="text" class="form-control" name="city" placeholder="" value="<?=$city?>"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="zip">Τ.Κ.</label>
                            <input type="text" class="form-control" name="zip" placeholder="" value="<?=$zip?>"
                                required>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Τρόπος πληρωμής</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked
                                required>
                            <label class="custom-control-label" for="credit">Πιστωτική/Χρεωστική Κάρτα</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="cash" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="cash">Αντικαταβολή</label>
                        </div>

                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block shopBtn" id="orderSubmitBtn"
                        type="submit">Ολοκλήρωση παραγγελίας</button>
                    <p id="alertZeroItems"></p>
                </form>
            </div>
        </div>
    </div>


    <?php
		include_once('components/footer.php');
	?>



</body>

</html>