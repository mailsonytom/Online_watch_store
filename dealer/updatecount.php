<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = $_POST['product_id'];
        $flag = 0;
        if (empty($_POST['count'])) {
            $flag = 1;
            $error = "Please enter the number of pieces to update";
        }
        if ($flag == 0) {
            $count = $_POST['count'];
            $updatesql = "UPDATE products SET count = '$count' WHERE id='$product_id'";
            mysqli_query($conn, $updatesql);
        }
    }
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = '$product_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo '<script type="text/javascript">
                    window.location = "productlist.php"
                    </script>';
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
            <div class="row mt-5 pt-5">
                <div class="col-md-4">
                    <img src="../images/<?php echo $row['image'] ?>" alt="" class="img-fluid" />
                </div>
                <div class="col-md-8">
                    <h1>Watch name: <?php echo $row['name'] ?></h1>
                    <span>Brand: <?php echo $row['brand'] ?></span>
                    <br>
                    <span class="badge badge-secondary"><?php echo $row['gender']; ?></span>
                    <span class="badge badge-primary"><?php echo $row['type']; ?></span>
                    <p><?php echo $row['description']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="POST">
                        <span class="error"><?php echo $error; ?></span>
                        <div class="form-group">
                            <label>Update the number of pieces available</label>
                            <input type="text" class="form-control" name="count" value="<?php echo $row['count']; ?>" />
                            <input type="text" name="product_id" hidden value="<?php echo $product_id; ?>" />
                            <input type="Submit" value="Submit" class="btn  btn-secondary mt-3">
                        </div>
                    </form>
                    <hr>
                    <?php foreach ($data as $a) { ?>
                        <p class="card-text"><?php echo $a['comment'] ?></p>
                    <?php } ?>
                </div>
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