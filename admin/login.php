<?php include 'connect.php' ?>
<?php
session_start();
if (isset($_SESSION['admin'])) {
    include 'logout.php';
}
$username = $password = $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['id'];
            echo '<script type="text/javascript">
                window.location = "unapproved.php"
                 </script>';
        } else {
            $error = "Wrong password.";
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
                        <a href="../user/" class="nav-link border border-light rounded waves-effect">
                            Login as user
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="../dealer/" class="nav-link border border-light rounded waves-effect">
                            Login as dealer
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->
    <div class="container-fluid pt-5" >
        <div class="row" style="height: 150vh;">
            <div class="admin-banner col-md-6 p-0">
            </div>
            <div class="col-md-6">
                <h2 class="mt-5 col-md-12 text-center">Sign-in as admin</h2>
                <form action="" method="POST" class="col-md-12 mt-5 py-2 border border-dark rounded">
                    <span class="error"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <input type="submit" value="Submit" class="btn btn-block btn-secondary">
                </form>
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

</html>