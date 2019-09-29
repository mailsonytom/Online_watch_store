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
        <title>
            User Sign up
        </title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Online Watch Store</a>
        </nav>
        <div class="container">
            <div class="row">
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
        <hr>
    </body>
<?php } ?>

    </html>