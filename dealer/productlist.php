<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    $limit = 3;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $dealer_id = $_SESSION['dealer'];
    $sql = "SELECT * FROM products WHERE dealer_id='$dealer_id' LIMIT $start_from, $limit";
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
            <div class="row mx-1 mt-5 pt-5">
                <h2 class="col-md-12 mt-2">Product List</h2>
                <div class="col-md-12">
                    <?php foreach ($data as $a) { ?>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading"><?php echo $a['name']; ?></h4>
                            <p><?php echo $a['description']; ?></p>
                            <span class="badge badge-primary"><?php echo $a['brand']; ?></span>
                            <span class="badge badge-secondary"><?php echo $a['code']; ?></span>
                            <span class="badge badge-success"><?php echo $a['category']; ?></span>
                            <span class="badge badge-danger"><?php echo $a['gender']; ?></span>
                            <span class="badge badge-warning"><?php echo $a['type']; ?></span>
                            <span class="badge badge-info"><?php echo $a['count']; ?> pieces remaining</span>
                            <hr>
                            <p class="mb-0">Price in INR: <?php echo $a['price']; ?></p>
                            <a href="updatecount.php?id=<?php echo $a['id']; ?>"><button class="btn btn-primary mt-2">Update inventory</button></a>
                        </div>
                    <?php } ?>
                </div>
                <?php
                    $sql = "SELECT COUNT(id) FROM products WHERE dealer_id='$dealer_id'";
                    $rs_result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_row($rs_result);
                    $total_records = $row[0];
                    $total_pages = ceil($total_records / $limit);
                    $pagLink = "<div class='pagination mt-3'>";
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $pagLink .= "<li class='page-item'><a class='page-link' href='productlist.php?page=" . $i . "'>" . $i . "</a></li>";
                    };
                    echo $pagLink . "</div>";
                    ?>
            </div>
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