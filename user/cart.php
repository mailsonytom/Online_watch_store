<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM products INNER JOIN cart on cart.product_id = products.id WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    ?>
    <!doctype html>
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
                            <a href="products.php" class="nav-link border border-light rounded waves-effect">
                                Products
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
        <div class="container">
            <div class="row mt-5 mb-3 pt-5">
                <div class="col-md-8">
                    <h3 class="h3">Your online watch store cart</h3>
                </div>
            </div>
            <div class="row">
                <?php $total = 0;
                    if ($num_rows > 0) {
                        foreach ($data as $a) { ?>
                        <div class="alert alert-success col-md-12" role="alert">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="../images/<?php echo $a['image'] ?>" alt="" class="img-fluid col-md-8" />
                                </div>
                                <div class="col-md-3">
                                    <h4 class="alert-heading"><?php echo $a['name']; ?></h4>
                                    <p class="text-dark"><?php echo $a['description']; ?></p>
                                    <span class="badge badge-primary"><?php echo $a['brand']; ?></span>
                                    <span class="badge badge-secondary"><?php echo $a['code']; ?></span>
                                    <span class="badge badge-success"><?php echo $a['category']; ?></span>
                                    <span class="badge badge-danger"><?php echo $a['gender']; ?></span>
                                    <span class="badge badge-warning"><?php echo $a['type']; ?></span>
                                    <p class="mb-0">Price in INR: ₹<?php echo $a['price']; ?></p>
                                </div>
                                <div class="col-md-1 offset-4">
                                    <span class="badge badge-success">Count: <?php echo $a['count']; ?></span>
                                    <span class="badge badge-warning">Price: ₹<?php echo $a['count'] * $a['price'];
                                                                                            $total += $a['count'] * $a['price']; ?></span>
                                    <a href="removefromcart.php?id=<?php echo $a['id']; ?>"><span class="mt-4 badge badge-danger">Remove from cart</span></a>
                                </div>
                            </div>
                        </div>
                <?php }
                    } ?>
            </div>
            <hr>
            <div class="row mt-5 mb-3">
                <div class="col-md-8">
                    <h3 class="h3">Total amount: ₹<?php echo $total; ?></h3>
                    <?php
                        if ($total > 0) { ?>
                        <a href="payment.php"><button class="btn btn-primary">Checkout</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <hr>
        <!--Footer-->
        <footer class="page-footer text-center font-small mt-4 wow fadeIn">
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