<?php
session_start();
include 'components/header.php';
require 'components/searchModal.php';
require 'vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->users;


$uemail=$_GET['uemail'];
$cursor = $collection -> find(['uemail' => $uemail]);

foreach ($cursor as $document) { 
    $firstName = $document["firstName"]; 
    $lastName = $document["lastName"];
    $age = $document["age"];
    $phone = $document["phone"];
    $city = $document["city"];
    $address = $document["address"];
    $zip = $document["zip"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
    <title>My Account</title>
</head>

<div class="container py-5 my-5">
    <div class="col-12">
        <form action="dbServices/userUpdate.php?uemail=<?=$_SESSION['uemail']?>" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" name="firstName" value="<?=$firstName?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" name="lastName" value="<?=$lastName?>" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" name="age" value="<?=$age?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?=$phone?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="<?=$address?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" value="<?=$city?>" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" name="zip" value="<?=$zip?>" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

</html>
<?php
include "components/footer.php";
?>