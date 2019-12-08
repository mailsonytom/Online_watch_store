<?php include 'connect.php' ?>
<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = $email = $password = $address = $phone = $gender = $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flag = 0;
    if (empty($_POST["name"])) {
        $error = "Name is required";
        $flag = 1;
    } else {
        $name = test_input($_POST['name']);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $flag = 1;
            $error = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["email"])) {
        $error = "Email is required";
        $flag = 1;
    } else {
        $email = test_input($_POST['email']);
        // check if email format is correct
        if (!filter_var($email, FILTER_VALIDATE_EMAIL, $email)) {
            $flag = 1;
            $error = "Wrong email format";
        }
    }
    if (empty($_POST["password"])) {
        $error = "Password is required";
        $flag = 1;
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    if (empty($_POST["phone"])) {
        $error = "Phone number is required";
        $flag = 1;
    } else {
        $phone = test_input($_POST['phone']);
        $parent_pass = password_hash($_POST['phone'], PASSWORD_DEFAULT);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[1-9][0-9]{9}$/", $phone)) {
            $flag = 1;
            $error = "Wrong phone number format";
        }
    }
    if (empty($_POST["address"])) {
        $error = "Address is required";
        $flag = 1;
    } else {
        $address = test_input($conn->real_escape_string($_POST['address']));
    }
    $gender = $_POST['gender'];
    $select_query = "SELECT email FROM users";
    $result = mysqli_query($conn, $select_query);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email) {
            $error = "Email already exist";
            $flag = 1;
        }
    }
    if ($flag == 0) {
        $sql = "INSERT INTO users (name, email, password, phone, address, gender) 
        VALUES ('$name', '$email', '$password', '$phone', '$address', '$gender')";
        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">
                    window.location = "login.php"
                    </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
                    <li class="nav-item active">
                        <a class="nav-link waves-effect" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/">About MDB</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/getting-started/download/">Free download</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="https://mdbootstrap.com/education/bootstrap/">Free
                            tutorials</a>
                    </li>
                </ul>

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="login.php" class="nav-link border border-light rounded waves-effect">
                            Sign in
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->
    <div class="container-fluid">
        <div class="row p-0">
            <div class="left-banner col-md-6 p-0">

            </div>
            <div class="col-md-6 mt-5 px-5 py-5">
                <h4 class="text-dark">User registration</h4>
                <p class="text-muted">
                    Sign up for the luxury of time !!
                </p>
                <form action="" method="POST">
                    <span class="error"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label class="text-secondary">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label class="text-secondary">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label class="text-secondary">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label class="text-secondary">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary">Phone number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter your phone">
                    </div>
                    <div class="form-group">
                        <label class="text-secondary">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter your address">
                    </div>
                    <input type="submit" name="submit" value="Sign up" class="btn btn-secondary">
                </form>
            </div>
            <br>
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