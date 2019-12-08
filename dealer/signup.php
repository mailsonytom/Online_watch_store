<?php include 'connect.php' ?>
<?php
$name = $owner = $email = $phone = $password = $location = $address = $bio = $error = "";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
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
    if (empty($_POST["owner"])) {
        $error = "Onwer is required";
        $flag = 1;
    } else {
        $owner = test_input($_POST['owner']);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $owner)) {
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
    if (empty($_POST["location"])) {
        $error = "Location is required";
        $flag = 1;
    } else {
        $location = test_input($_POST['location']);
        if (!preg_match("/^[a-zA-Z ]*$/", $location)) {
            $flag = 1;
            $error = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["address"])) {
        $error = "Address is required";
        $flag = 1;
    } else {
        $address = test_input($conn->real_escape_string($_POST['address']));
    }
    if (empty($_POST["phone"])) {
        $error = "Phone number is required";
        $flag = 1;
    } else {
        $phone = test_input($_POST['phone']);
        if (!preg_match("/^[1-9][0-9]{9}$/", $phone)) {
            $flag = 1;
            $error = "Wrong phone number format";
        }
    }
    if (empty($_POST["bio"])) {
        $error = "Bio is required";
        $flag = 1;
    } else {
        $bio = test_input($conn->real_escape_string($_POST['bio']));
    }
    $select_query = "SELECT * FROM dealer";
    $result = mysqli_query($conn, $select_query);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email) {
            $flag = 1;
            $error = "Email already exists";
        }
    }
    if ($flag == 0) {
        $sql = "INSERT INTO dealer (name, owner, email, password, location, address, phone, bio, approved) 
        VALUES ('$name', '$owner', '$email', '$password', 'location', '$address', '$phone', '$bio', 0)";
        if ($conn->query($sql) === TRUE) {
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
    <title>
        Sign up - Dealer
    </title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Online Watch Store Dealer Portal</a>
        <a href="../user/" class="ml-auto mr-3"><button class="btn btn-outline-primary">I'm a user</button></a>
        <a href="login.php" class="mr-3"><button class="btn btn-outline-primary">Login</button></a>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="left-banner-dealer col-md-6 p-0">

            </div>
            <div class="col-md-6">
                <h2 class=" col-md-12 text-center mt-2 mx-auto">Dealer Sign-up</h2>
                <form action="" method="POST" class=" mx-auto mt-5 px-2 py-2">
                    <span class="error"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Owner's name</label>
                        <input type="text" class="form-control" name="owner">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label>Bussiness phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="textarea" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label>Short bio</label>
                        <input type="textarea" class="form-control" name="bio">
                    </div>
                    <input type="submit" name="submit" value="Sign up" class="btn btn-block btn-primary">
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