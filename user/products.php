<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    $user_id = $_SESSION['user_id'];
    $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM users WHERE id='$user_id'"))['name'];
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $cart_sql = "SELECT * FROM cart WHERE user_id=" . $user_id;
    $result = mysqli_query($conn, $cart_sql);
    $cartnumber = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $cartnumber = $cartnumber + $row['count'];
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Online Watch Store</a>
            <a href="logout.php" class="ml-auto mr-3"><button class="btn btn-outline-info">Logout</button></a>
        </nav>
        <div class="container">

            <div class="row mt-5 mb-3 top-strip">
                <div class="col-md-8">
                    <h6 class="h6 text-danger">Welcome <?php echo $name; ?></h6>
                </div>
                <div class="col-md-8">
                    <h3 class="h3">Purchase your favourite watch</h3>
                </div>
                <div class="col-md-1 offset-3">
                    <a href="cart.php">
                        <button type="button" class="btn btn-warning">
                            <img src="../assets/images/cart.png" class="img-fluid" />
                            <span class="badge badge-dark"><?php echo $cartnumber; ?></span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="row">
                <?php foreach ($data as $a) { ?>
                    <div class="col-md-3 col-sm-6">
                        <a href="productdetails.php?id=<?php echo $a['id']; ?>">
                            <div class="product-grid6">
                                <div class="product-image6 mt-5">
                                    <img class="pic-1 img-fluid" src="../images/<?php echo $a['image']; ?>">
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><?php echo $a['name']; ?>
                        </a></h3>
                        <div class="price">Price: ₹<?php echo $a['price']; ?></div>
                        <a href="updatecart.php?id=<?php echo $a['id']; ?>"><button class="btn btn-warning">Add to cart</button>
                    </div>
            </div>
            </a>
        </div>
    <?php } ?>
    </div>
    </div>
    <hr>
    </body>
<?php } ?>

    </html>