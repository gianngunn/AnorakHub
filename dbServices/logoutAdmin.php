<?php
session_start();
unset($_SESSION['uemail']);
unset($_SESSION['isAdmin']);
?>
<!--alert edw?-->
<?php
header("Location: ../index.php")
?>