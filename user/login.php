<?php include 'connect.php' ?>
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include 'logout.php';
} else {
    $email = $password = $error = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                echo '<script type="text/javascript">
                    window.location = "products.php"
                    </script>';
            } else {
                $error = "Wrong password";
            }
        } else {
            $error = "Wrong username";
        }
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
            height: 90vh;
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
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="../">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="about.html">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="../dealer/">Dealer Portal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="../admin/">Admin Portal</a>
                    </li>
                </ul>

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link border border-light rounded waves-effect">
                            Sign up
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->
    <div class="container-fluid">
        <div class="row" style="height: 90vh;">
            <div class="col-md-6" style="background-image: url('../assets/images/loginb.jpg'); background-size:cover;">

            </div>
            <div class="col-md-6 mt-5 p-5">
                <h2 class="mt-5 text-dark">Sign-in as user</h2>
                <p class="text-muted">
                    You can add them to your cart and purchase them at your convenicene
                </p>
                <form action="" method="POST">
                    
                    <div class="form-group">
                        <label class="text-secondary">Email address</label>
                        <input type="email" name="email" placeholder="Enter your email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="text-secondary">Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <input type="submit" value="Login" class="btn btn-secondary">
                    <br><span class="error"><?php echo $error; ?></span>
                </form>
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

</html>