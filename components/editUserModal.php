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



    <div id="editUserModal" class="container">
        <form action="../dbServices/updateUser.php?uemail=<?=$uemail?>" method="post">
            <div class="row">
                <div class="col-4">
                    <h1>Επεξεργασία Χρήστη</h1>

                    <hr>
                    <label for="firstName"><b>Όνομα</b></label>
                    <input type="text" value="<?=$firstName?>" name="firstName" required>

                    <label for="lastName"><b>Επώνυμο</b></label>
                    <input type="text" value="<?=$lastName?>" name="lastName" required>

                    <label for="age"><b>Ηλικία</b></label>
                    <input type="text" value="<?=$age?>" name="age" required>

                    <label for="phone"><b>Τηλέφωνο</b></label>
                    <input type="text" value="<?=$phone?>" name="phone" required>

                    <label for="city"><b>Πόλη</b></label>
                    <input type="text" value="<?=$city?>" name="city" required>

                    <label for="address"><b>Οδός</b></label>
                    <input type="text" value="<?=$address?>" name="address" required>

                    <label for="zip"><b>TK</b></label>
                    <input type="text" value="<?=$zip?>" name="zip" required>


                    <div class="clearfix">
                        <a href="../editUsersPage.php" class="cancelbtn">Cancel</a>
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