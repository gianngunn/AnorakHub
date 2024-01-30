<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="./css/ah_style.css" />
    <script src=""></script>
    <link rel="icon" type="image/x-icon" href="./img/anorak_final.png" />

</head>

<body id="mainPage">
    <!------------------------------------------------------------------------------------------------------------------------->
    <?php
if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin'] == 'yes'){
       ?> <section id="header">
        <div class="container-fluid">
            <div class="row align-items-center" id="topnav">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <a class="navbar-brand" href="./index.php">
                        <img src="./img/anorak_final.png" class="rounded" id="logo" />
                    </a>
                </div>
                <div class="col-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="./cart.php" title="Cart"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                        <div class="col-auto px-0">
                            <a onclick="document.getElementById('searchModal').style.display='block'" title="Search"><i
                                    class="fa fa-fw fa-search"></i></a>
                        </div>
                        <div class="dropdown show px-5">

                            <a class="btn btn-outline-secondery dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Selides Admin
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="./editUsersPage.php">selEpXriston</a>
                                <a class="dropdown-item" href="./editProductPage.php">selEpProionton</a>
                                <a class="dropdown-item" href="./editOrdersPage.php">selEpParaggelion</a>
                            </div>
                        </div>


                        <div class="col-auto px-0">
                            <a href="dbServices/logoutAdmin.php" class="btn btn-outline-secondary">Logout</a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-outline-secondary">Anorak Lab</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 py-4 text-center justify-content-center navbar navbar-default" id="secondNav">
                    <ul class="nav text-center" id="menul">
                        <div class="dropdown show px-5">

                            <a class="btn btn-outline-secondery dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Προϊόντα
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="./cigar.php">Πούρα</a>
                                <a class="dropdown-item" href="./whiskey.php">Ουίσκι</a>
                                <a class="dropdown-item" href="./wine.php">Κρασία</a>
                            </div>
                        </div>
                        <li class="px-5">
                            <a href="./aboutus.php">About us</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>




        <div class="\"></div>
        <!--</nav>-->
    </section>
    <!------------------------------------------------------------------------------------------------------------------------->
    <?php }
}elseif(isset($_SESSION['uemail'])){
?>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
    <section id="header">
        <div class="container-fluid">
            <div class="row align-items-center" id="topnav">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <a class="navbar-brand" href="./index.php">
                        <img src="./img/anorak_final.png" class="rounded" id="logo" />
                    </a>
                </div>
                <div class="col-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="./cart.php?uemail=<?=$_SESSION['uemail']?>" title="Cart"><i
                                    class="fa fa-shopping-cart"></i></a>
                        </div>
                        <div class="col-auto px-0">
                            <a onclick="document.getElementById('searchModal').style.display='block'" title="Search"><i
                                    class="fa fa-fw fa-search"></i></a>
                        </div>
                        <div class="col-auto">
                            <a href="myAccount.php?uemail=<?=$_SESSION['uemail']?>" class="btn btn-outline-secondary">My
                                Account</a>
                        </div>
                        <div class="col-auto px-0">
                            <a href="dbServices/logoutUser.php" class="btn btn-outline-secondary">Logout</a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-outline-secondary">Anorak Lab</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 py-4 text-center justify-content-center navbar navbar-default" id="secondNav">
                    <ul class="nav text-center" id="menul">
                        <li class="dropdown show px-5">

                            <a class="btn btn-outline-secondery dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Προϊόντα
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="./cigar.php">Πούρα</a>
                                <a class="dropdown-item" href="./whiskey.php">Ουίσκι</a>
                                <a class="dropdown-item" href="./wine.php">Κρασία</a>
                            </div>
                        </li>
                        <li class="px-5">
                            <a href="./aboutus.php">About us</a>
                        </li>

                        <li class="px-5">
                            <a href="./favoritesPage.php">Αγαπημένα</a>
                        </li>

                        <li class="px-5">
                            <a href="./myOrdersPage.php">Παραγγελίες μου</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>




        <div class="\"></div>
        <!--</nav>-->
    </section>

    <!------------------------------------------------------------------------------------------------------------------------->
    <?php
}

else{
?>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
    <section id="header">
        <div class="container-fluid">
            <div class="row align-items-center" id="topnav">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <a class="navbar-brand" href="./index.php">
                        <img src="./img/anorak_final.png" class="rounded" id="logo" />
                    </a>
                </div>
                <div class="col-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="./cart.php?uemail=<?$_SESSION['uemail']?>" title="Cart"><i
                                    class="fa fa-shopping-cart"></i></a>
                        </div>
                        <div class="col-auto px-0">
                            <a onclick="document.getElementById('searchModal').style.display='block'" title="Search"><i
                                    class="fa fa-fw fa-search"></i></a>
                        </div>
                        <div class="col-auto">
                            <a onclick="document.getElementById('id01').style.display='block'"
                                class="btn btn-outline-secondary">Login</a>
                        </div>
                        <div class="col-auto px-0">
                            <a onclick="document.getElementById('id02').style.display='block'"
                                class="btn btn-outline-secondary">Signup</a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-outline-secondary">Anorak Lab</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 py-4 text-center justify-content-center navbar navbar-default" id="secondNav">
                    <ul class="nav text-center" id="menul">
                        <li class="dropdown show px-5">

                            <a class="btn btn-outline-secondery dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Προϊόντα
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="./cigar.php">Πούρα</a>
                                <a class="dropdown-item" href="./whiskey.php">Ουίσκι</a>
                                <a class="dropdown-item" href="./wine.php">Κρασία</a>
                            </div>
                        </li>
                        <li class="px-5">
                            <a href="./aboutus.php">About us</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>




        <div class="\"></div>
        <!--</nav>-->
    </section>
    <?php    
}
?>

</body>

</html>