<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        while ($commentrow = mysqli_fetch_assoc($commentresult)) {
            $data[] = $commentrow;
        }
        $flag = 0;
        if (empty($_POST['comment'])) {
            $flag = 1;
            $error = "Type your comment first";
        }
        if ($flag == 0) {
            $comment = test_input($conn->real_escape_string($_POST['comment']));
            $insertsql = "INSERT INTO comments (user_id, product_id, comment) VALUES ('$user_id', '$product_id', '$comment')";
            mysqli_query($conn, $insertsql);
        }
    }
    if (isset($_GET['id'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = '$product_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $commentsql = "SELECT * FROM comments WHERE product_id = '$product_id' AND user_id='$user_id'";
        $commentresult = mysqli_query($conn, $commentsql);
        while ($commentrow = mysqli_fetch_assoc($commentresult)) {
            $data[] = $commentrow;
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
                            <a href="cart.php" class="nav-link border border-light rounded waves-effect">
                                Cart
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
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="../images/<?php echo $row['image'] ?>" alt="" class="img-fluid" />
                </div>
                <div class="col-md-8">
                    <h1>Watch name: <?php echo $row['name'] ?></h1>
                    <p><?php echo $row['description'] ?></p>
                    <span>Brand: <?php echo $row['brand'] ?></span>
                    <br>
                    <span class="badge badge-secondary"><?php echo $row['gender']; ?></span>
                    <span class="badge badge-primary"><?php echo $row['type']; ?></span>
                    <p><?php echo $row['description']; ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Write a comment</label>
                            <textarea name="comment" class="form-control" placeholder="Write a comment"></textarea>
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