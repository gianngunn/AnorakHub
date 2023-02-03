<?php
session_start();
include 'components/header.php';

require 'components/searchModal.php';

#if(isset($_POST['uemail'])i me to $_SESSION{
#ean kapoios paei na mpei apo to url
#})
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
                    <input type="text" class="form-control" name="firstName" placeholder="" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" name="lastName" placeholder="" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" name="age" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" name="zip" required>
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