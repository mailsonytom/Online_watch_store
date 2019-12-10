<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "login.php"
                 </script>';
} else {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>
            Add new watch
            </title<!doctype html>
            <html lang="en">

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title>Online Watch Store</title>
                <link href="../assets/css/bootstrap.css" rel="stylesheet">
                <link href="../assets/css/mdb.min.css" rel="stylesheet">
                <link href="../assets/css/style.css" rel="stylesheet">
                <link href="../assets/css/style.min.css" rel="stylesheet">
                <style type="text/css">
                    html,
                    body,
                    header,
                    .carousel {
                        height: 60vh;
                    }
                </style>
            </head>

    <body>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container">

                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="/">
                    <strong class="blue-text">OWS</strong>
                </a>

                <!-- Collapse -->

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item mr-2">
                            <a href="productlist.php" class="nav-link border border-light rounded waves-effect">
                                See my products
                            </a>
                        </li>
                        <li class="nav-item mr-2">
                            <a href="shipping.php" class="nav-link border border-light rounded waves-effect">
                                Pending shipping
                            </a>
                        </li>
                        <li class="nav-item mr-2">
                            <a href="logout.php" class="nav-link border border-light rounded waves-effect">
                                Logout
                            </a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>
        <!-- Navbar -->
        <div class="container-fluid">
            <div class="row" style="height: 50vh; background-image:url('../assets/images/w1.jpg'); background-size: cover;">
                <div class="col-md-12 text-center">
                    <h1 style="margin-top:10rem; color: #fff;">The watches you'll dream to wear !! </h1>
                </div>
            </div>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>Welcome to the dealer dashboard</h4>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="alert alert-info col-md-6">
                        <h4 class="alert-heading">Add a new product</h4>
                        <p>You can add new products in your arena to attract customers</p>
                        <a href="addnew.php" class="btn btn-success">Click here to add</a>
                    </div>
                    <div class="alert alert-info col-md-6">
                        <h4 class="alert-heading">List of added products</h4>
                        <p>You can see the list of products in your inventory</p>
                        <a href="productlist.php" class="btn btn-success">Click here to view</a>
                    </div>

                    <div class="alert alert-info col-md-6">
                        <h4 class="alert-heading">Pending shippings</h4>
                        <p>You can see the orders that are pending for shipping in your inventory</p>
                        <a href="shipping.php" class="btn btn-success">Click here to view</a>
                    </div>

                    <div class="alert alert-info col-md-6">
                        <h4 class="alert-heading">List of shipped orders</h4>
                        <p>You can see the list of orders you had shipped</p>
                        <a href="shipped.php" class="btn btn-success">Click here to view</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!--Footer-->
        <footer class="page-footer text-center font-small wow fadeIn">
            <!--Copyright-->
            <div class="footer-copyright py-3">
                © 2019 Copyright: Online Watch Store </a>
            </div>
            <!--/.Copyright-->

        </footer>
        <!--/.Footer-->

        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="../assets/js/jquery-3.4.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../assets/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
        <!-- Initializations -->
        <script type="text/javascript">
            // Animations initialization
            new WOW().init();
        </script>
    </body>
<?php } ?>

    </html>