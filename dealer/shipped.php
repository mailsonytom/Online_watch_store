<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    $limit = 4;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $dealer_id = $_SESSION['dealer'];
    $sql = "SELECT product_id, shipped, purchases.price, purchases.count, name, brand, code, category, gender, type, dealer_id 
    FROM purchases INNER JOIN products ON purchases.product_id = products.id WHERE dealer_id='$dealer_id' AND shipped=1 LIMIT $start_from, $limit";
    $result = mysqli_query($conn, $sql);
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
                            <a href="dashboard.php" class="nav-link border border-light rounded waves-effect">
                                Back to dashboard
                            </a>
                        </li>
                        <li class="nav-item mr-2">
                            <a href="productlist.php" class="nav-link border border-light rounded waves-effect">
                                List of products
                            </a>
                        </li>
                        <li class="nav-item mr-2">
                            <a href="addnew.php" class="nav-link border border-light rounded waves-effect">
                                Add new product
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
            <div class="row mt-5">
                <h2 class="col-md-12 mt-5">Shipped products list</h2>
                <?php $total = 0;
                    foreach ($data as $a) { ?>
                    <div class="alert alert-success col-md-12" role="alert">
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="alert-heading"><?php echo $a['name']; ?></h4>
                                <span class="badge badge-primary"><?php echo $a['brand']; ?></span>
                                <span class="badge badge-secondary"><?php echo $a['code']; ?></span>
                                <span class="badge badge-success"><?php echo $a['category']; ?></span>
                                <span class="badge badge-danger"><?php echo $a['gender']; ?></span>
                                <span class="badge badge-warning"><?php echo $a['type']; ?></span>
                            </div>
                            <div class="col-md-1 offset-4">
                                <span class="badge badge-warning">Total order value: ₹<?php echo $a['count'] * $a['price'];
                                                                                                $total += $a['count'] * $a['price']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
                $sql = "SELECT COUNT(purchases.id) FROM products INNER JOIN purchases on purchases.product_id = products.id WHERE dealer_id='$dealer_id' AND shipped=1";
                $rs_result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($rs_result);
                $total_records = $row[0];
                $total_pages = ceil($total_records / $limit);
                $pagLink = "<div class='pagination mt-3'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    $pagLink .= "<li class='page-item'><a class='page-link' href='shipped.php?page=" . $i . "'>" . $i . "</a></li>";
                };
                echo $pagLink . "</div>";
                ?>
        </div>
        <!--Footer-->
        <footer class="page-footer text-center font-small">
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