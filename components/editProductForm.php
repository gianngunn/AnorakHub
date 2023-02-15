<!DOCTYPE html>
<html>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

* {
    box-sizing: border-box;
}

/* Full-width input fields */
input[type=email],
input[type=text] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=email]:focus,
input[type=text]:focus {
    background-color: #ddd;
    outline: none;
}

/* Set a style for all buttons */
button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity: 1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,
.signupbtn {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* The Modal (background) */
.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto;
    /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 50% !important;
    /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
}

.close:hover,
.close:focus {
    color: #f44336;
    cursor: pointer;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {
        -webkit-transform: scale(0)
    }

    to {
        -webkit-transform: scale(1)
    }
}

@keyframes animatezoom {
    from {
        transform: scale(0)
    }

    to {
        transform: scale(1)
    }
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {

    .cancelbtn,
    .signupbtn {
        width: 100%;
    }
}
</style>

<body>

    <?php 


require '../vendor/autoload.php';

$m = new MongoDB\Client ("mongodb://127.0.0.1/");
$db = $m->AnorakHub;
$collection = $db->products;


$productCode=$_GET['productCode'];
$cursor = $collection -> find(['productCode' => $productCode]);

foreach ($cursor as $document) { 
    $name = $document["name"]; 
    $price = $document["price"];
    $stock = $document["stock"];
    $description = $document["description"];
    $image = $document["image"];
    
    $productIs = $document["productIs"];
}

?>



    <div id="editProductForm" class="container">
        <form action="../dbServices/updateProduct.php?productCode=<?=$productCode?>" method="post">
            <div class="row">
                <div class="col-4">
                    <h1>Επεξεργασία Προϊόντος</h1>

                    <hr>
                    <label for="name"><b>Όνομα</b></label>
                    <input type="text" value="<?=$name?>" name="name" required>

                    <label for="price"><b>Τιμή</b></label>
                    <input type="text" value="<?=$price?>" name="price" required>

                    <label for="stock"><b>Απόθεμα</b></label>
                    <input type="text" value="<?=$stock?>" name="stock" required>

                    <label for="description"><b>Περιγραφή</b></label>
                    <input type="text" value="<?=$description?>" name="description" required>

                    <label for="image"><b>Εικόνα</b></label>
                    <input type="text" value="<?=$image?>" name="image" required>


                    <label for="productIs"><b>Κατηγορία</b></label>
                    <input type="text" value="<?=$productIs?>" name="productIs" required>


                    <div class="clearfix">
                        <a href="../editProductPage.php" class="cancelbtn">Cancel</a>
                        <button type="submit" class="updatebtn">Ενημέρωση</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!--<script>
    // Get the modal
   // var modal = document.getElementById('editUserModal');

    // When the user clicks anywhere outside of the modal, close it
    //window.onclick = function(event) {
    //    if (event.target == modal) {
     //       modal.style.display = "none";
      //  }
   // }
    </script>-->

</body>

</html>