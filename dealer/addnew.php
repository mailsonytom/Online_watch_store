<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "login.php"
                 </script>';
} else {
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $dealer_id = $_SESSION['dealer'];
    $name = $brand = $code = $category = $gender = $type = $price = $image = $description = $error = $count = "";
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
        if (empty($_POST["brand"])) {
            $error = "Brand is required";
            $flag = 1;
        } else {
            $brand = test_input($_POST['brand']);
            if (!preg_match("/^[a-zA-Z ]*$/", $brand)) {
                $flag = 1;
                $error = "Only letters and white space allowed";
            }
        }
        if (empty($_POST["code"])) {
            $error = "Code is required";
            $flag = 1;
        } else {
            $code = test_input($_POST['code']);
            if (!preg_match("/^[a-zA-Z\d]*$/", $code)) {
                $flag = 1;
                $error = "Wrong code format. Use letters and numbers only.";
            }
        }


        $category = $_POST['category'];
        $gender = $_POST['gender'];
        $type = $_POST['type'];
        if (empty($_POST["price"])) {
            $error = "Price is required";
            $flag = 1;
        } else {
            $price = test_input($_POST['price']);
            if (!preg_match("/^[\d]*$/", $price)) {
                $flag = 1;
                $error = "Price is in wrong format.";
            }
        }
        if (empty($_POST["count"])) {
            $error = "Count is required";
            $flag = 1;
        } else {
            $count = test_input($_POST['count']);
            if (!preg_match("/^[\d]*$/", $count)) {
                $flag = 1;
                $error = "Count is in wrong format.";
            }
        }
        $description = test_input($conn->real_escape_string($_POST['description']));
        $image = $_FILES['image']['name'];
        $extension = end(explode(".", $image));
        $newfilename = $code . "." . $extension;
        $target = "../images/" . $newfilename;
        $code_result = mysqli_query($conn, "SELECT code FROM products");
        while ($row = mysqli_fetch_assoc($code_result)) {
            if ($row['code'] == $code) {
                $error = "Product code already exist";
                $flag = 1;
            }
        }
        if (!$flag) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $sql = "INSERT INTO products (name, brand, code, category, gender, type, price, count, image, description, dealer_id) 
            VALUES ('$name', '$brand', '$code', '$category', '$gender', '$type', '$price', '$count', '$newfilename', '$description', '$dealer_id')";
            mysqli_query($conn, $sql);
            echo '<script type="text/javascript">
                window.location = "productlist.php"
                 </script>';
        }
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>
            Add new watch
            </title<!doctype html>
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
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item mr-2">
                            <a href="shipping.php" class="nav-link border border-light rounded waves-effect">
                                Pending shipping
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
        <div class="container-fluid">
            <div class="row" style="height: 50vh; background-image:url('../assets/images/banner.jpg'); background-size: cover;">
                <div class="col-md-12 text-center">
                </div>
            </div>
            <div class="row mx-1 pt-5">
                <h2 class=" col-md-5 text-center mt-2 mx-auto">Add New Watch</h2>
                <form action="" method="POST" class="col-md-8 mx-auto mt-5 px-2 py-2 border border-dark rounded" enctype="multipart/form-data">
                    <span class="error"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" class="form-control" name="brand" id="Inputbrand">
                    </div>
                    <div class="form-group">
                        <label>Watch name</label>
                        <input type="text" class="form-control" name="name" id="Inputname">
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" id="Inputname">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="analog">Analog</option>
                            <option value="digital">Digital</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Strap type</label>
                        <select name="type" class="form-control">
                            <option value="strap">Strap</option>
                            <option value="chain">Chain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price">
                    </div>
                    <div class="form-group">
                        <label>Inventory count</label>
                        <input type="text" class="form-control" name="count">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" rows="5" class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label><br>
                        <input type="file" name="image" id="image">
                    </div>
                    <input type="submit" name="submit" value="Add watch" class="btn btn-block btn-secondary">
                </form>
                <br>
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