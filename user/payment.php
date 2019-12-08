<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    $cardno = $expiry = $cvv = $error = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST["cardno"])) {
            $error = "Card number is required";
            $flag = 1;
        } else {
            $cardno = $_POST["cardno"];
            if (!preg_match("/^[1-9][0-9]{15}$/", $cardno)) {
                $flag = 1;
                $error = "Wrong card number";
            }
        }
        if (empty($_POST["expiry"])) {
            $error = "Expiry date is required";
            $flag = 1;
        } else {
            $exp = $_POST["expiry"];
            if (!preg_match("/^[1][0-9]\/[0-9]{2}$/", $exp)) {
                $flag = 1;
                $error = "Wrong expiry date";
            }
        }
        if (empty($_POST["expiry"])) {
            $error = "Expiry date is required";
            $flag = 1;
        } else {
            $cvv = $_POST["cvv"];
            if (!preg_match("/^[0-9]{3}$/", $cvv)) {
                $flag = 1;
                $error = "Wrong cvv";
            }
        }
        if ($flag == 0) {
            $datetoday = date("Y/m/d");
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT price, product_id, cart.count FROM products INNER JOIN cart on cart.product_id = products.id WHERE user_id='$user_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            foreach ($data as $a) {
                $insertsql = "INSERT INTO purchases (product_id, user_id, count, date, shipped, price) VALUES(" .
                    $a['product_id'] . "," . $user_id . "," . $a['count'] . "," . $datetoday . ", 0," . $a['price']
                    . ")";
                mysqli_query($conn, $insertsql);
                $id = $a['product_id'];
                $currentcount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count FROM products WHERE id='$id'"))['count'];
                $newcount = $currentcount - $a['count'];
                mysqli_query($conn, "UPDATE products SET count='$newcount' WHERE id='$id'");
            }
            mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
            echo '<script type="text/javascript">
                    window.location = "products.php"
                    </script>';
        }
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
            <div class="row mt-5 pt-5 mb-3">
                <div class="col-md-8">
                    <h3 class="h3">Complete your payment</h3>
                </div>
            </div>
            <div class="row">
                <form action="" method="POST">
                    <label>Enter card number</label>
                    <input type="text" name="cardno" class="form-control" placeholder="Enter card nubmer" />
                    <label>Enter expiry date</label>
                    <input type="text" name="expiry" class="form-control" placeholder="MM/YY">
                    <label>Enter CVV</label>
                    <input type="password" name="cvv" class="form-control" placeholder="CVV">
                    <input type="submit" value="Submit" class="btn btn-secondary mt-3">
                    <br>
                    <span class="error"><?php echo $error; ?></span>
                </form>
            </div>
        </div>
        <hr>
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