<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    $limit = 10;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $user_id = $_SESSION['user_id'];
    $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users WHERE id='$user_id'"))['name'];
    $sql = "SELECT * FROM products LIMIT $start_from, $limit";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $cart_sql = "SELECT * FROM cart WHERE user_id=" . $user_id;
    $result = mysqli_query($conn, $cart_sql);
    $cartnumber = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $cartnumber = $cartnumber + $row['count'];
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
                            <a href="purchases.php" class="nav-link border border-light rounded waves-effect">
                                My purchases
                            </a>
                        </li>
                        <li class="nav-item mr-2">
                            <a href="cart.php" class="nav-link border border-light rounded waves-effect">
                                Cart
                                <span class="badge badge-dark"><?php echo $cartnumber; ?></span>
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
        <!--Carousel Wrapper-->
        <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner" role="listbox">

                <!--First slide-->
                <div class="carousel-item active">
                    <div class="view" style="background-image: url('../assets/images/w1.jpg'); background-repeat: no-repeat; background-size: cover;">

                        <!-- Mask & flexbox options-->
                        <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                            <!-- Content -->
                            <div class="text-center white-text mx-5 wow fadeIn">
                                <h1 class="mb-4">
                                    <strong>Buy your dream watch !! </strong>
                                </h1>

                                <p>
                                    <strong>Best & quality watches from around the world for your style.</strong>
                                </p>
                            </div>
                            <!-- Content -->

                        </div>
                        <!-- Mask & flexbox options-->

                    </div>
                </div>
                <!--/First slide-->
            </div>
            <!--/.Slides-->
        </div>
        <!--/.Carousel Wrapper-->
        <div class="container">
            <div class="row mt-5 mb-3">
                <div class="col-md-12">
                    <h2 class="text-dark">Welcome <?php echo $name; ?> !! </h2>
                    <p class="mb-4 d-none d-md-block">
                        OWS is the largest and most trusted authorized retailer for luxury watches in India. Buy 100% genuine luxury Watches for Men & Women
                    </p>
                </div>
            </div>
            <div class="row">
                <?php foreach ($data as $a) { ?>
                    <div class="col-md-3 col-sm-6">
                        <a href="productdetails.php?id=<?php echo $a['id']; ?>">
                            <div class="product-grid6 mt-3">
                                <div class="product-image6 mt-5">
                                    <img class="pic-1 img-fluid" src="../images/<?php echo $a['image']; ?>">
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><?php echo $a['name']; ?>
                        </a></h3>
                        <div class="price">Price: ₹<?php echo $a['price']; ?></div>
                        <a href="updatecart.php?id=<?php echo $a['id']; ?>"><button class="btn btn-warning">Add to cart</button>
                    </div>
            </div>

            </a>
        </div>
    <?php } ?>
    </div>
    <?php
        $sql = "SELECT COUNT(id) FROM products";
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);
        $pagLink = "<div class='pagination mt-3'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link' href='products.php?page=" . $i . "'>" . $i . "</a></li>";
        };
        echo $pagLink . "</div>";
        ?>
    </div>

    <hr>
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