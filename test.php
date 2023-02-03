<!DOCTYPE html>
<html>

<?php 
    session_start();
    include 'components/header.php'; 
    require 'components/productGrid.php';
    require 'components/singleProduct.php';
?>

<body>
    <div class="container mt-5">
        <div class="row">
            <?php
            $category = 'cigar';
            #populateProducts($category)
            displayProduct(); ?>
        </div>
    </div>

</body>

</html>