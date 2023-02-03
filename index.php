<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'components/header.php';
  require 'components/productDisplayMP.php';
  require 'components/loginModal.php';
  require 'components/signupModal.php';
  require 'components/searchModal.php';
?>

<body id="mainPage">

    <div class="row">
        <div class="col-4"></div>
        <div class="col-4"><?php include 'components/carouselMainPage.php' ?></div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            
            populateProductsMP() ?>

        </div>
    </div>

</body>
<?php include 'components/footer.php' ?>

</html>