<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "login.php"
                 </script>';
} else {
    $dealer_id = $_SESSION['user_id'];
    $name = $brand = $code = $category = $gender = $type = $price = $image = $description = $error = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $flag = 0;
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $code = $_POST['code'];
        $category = $_POST['category'];
        $gender = $_POST['gender'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $description = $_POST['description'];
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
        if (
            empty($_POST['name']) || empty($_POST['brand']) || empty($_POST['code']) || empty($_POST['category'])
            || empty($_POST['gender']) || empty($_POST['type']) || empty($_POST['price']) || empty($_POST['description'])
        ) {
            echo "test";
            $error = "Please fill in all the details";
            $flag = 1;
        }
        if (!$flag) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $sql = "INSERT INTO products (name, brand, code, category, gender, type, price, image, description, dealer_id) 
            VALUES ('$name', '$brand', '$code', '$category', '$gender', '$type', '$price', '$newfilename', '$description', '$dealer_id')";
            mysqli_query($conn, $sql);
        }
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>
            Add new watch
        </title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Online Watch Store</a>
        </nav>
        <div class="container">
            <div class="row mx-1">
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
                        <input type="text" class="form-control" name="price" id="exampleInputno">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" id="exampleInputdesc">
                    </div>
                    <div class="form-group">
                        <label>Image</label><br>
                        <input type="file" name="image" id="image">
                    </div>
                    <input type="submit" name="submit" class="btn btn-block btn-secondary">
                </form>
                <br>
            </div>

    </body>
<?php } ?>

    </html>