<?php include 'connect.php' ?>
<?php
session_start();
if (isset($_SESSION['dealer'])) {
    include 'logout.php';
}
$username = $password = $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM dealer WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password']) && $row['approved'] == 1) {
            $_SESSION['dealer'] = $row['id'];
            echo '<script type="text/javascript">
                window.location = "dashboard.php"
                 </script>';
        } else {
            $error = "Wrong password or you're not approved.";
        }
    } else {
        $error = "Wrong username.";
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
                        <a href="signup.php" class="nav-link border border-light rounded waves-effect">
                            Sign up
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="../user/" class="nav-link border border-light rounded waves-effect">
                            User
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="../admin/" class="nav-link border border-light rounded waves-effect">
                            Admin
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->
    <div class="container-fluid">
        <div class="row mt-5" style="height: 100vh;">
            <div class="left-banner-dealer col-md-6 p-0">
            </div>
            <div class="col-md-6">
                <h2 class=" col-md-12 mx-auto mt-5 text-center">Sign-in as dealer</h2>
                <form action="" method="POST" class=" mx-auto mt-5 px-2 py-2 border border-dark rounded">
                    <span class="error"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <input type="submit" value="Sign in" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    <!--Footer-->
    <footer class="page-footer text-center font-small wow fadeIn">
        <!--Copyright-->
        <div class="footer-copyright py-3" style="color: #fff;">
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