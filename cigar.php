<!DOCTYPE html>
<html>

<?php 
    session_start();
    include 'components/header.php'; 
    require 'vendor/autoload.php';
    require 'components/productGrid.php';
    require 'components/loginModal.php';
    include 'components/searchModal.php';
?>

<body>


    <div class="container mt-5">
        <div class="row">

            <?php
            $category = 'cigar';
            populateProducts($category) ?>
        </div>
    </div>


</body>
<?php include 'components/footer.php'; ?>

</html>