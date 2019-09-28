<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    $dealer_id = $_SESSION['dealer'];
    $sql = "SELECT name, brand, code, category, gender, type, purchases.price, image, description, dealer_id, purchases.id, count, shipped 
        FROM products INNER JOIN purchases on purchases.product_id = products.id WHERE dealer_id='$dealer_id' AND shipped=0";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
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
            <div class="row mt-5 mb-3 top-strip">
                <div class="col-md-8">
                    <h3 class="h3">Your online watch store cart</h3>
                </div>
            </div>
            <div class="row">
                <?php $total = 0;
                    foreach ($data as $a) { ?>
                    <div class="alert alert-success col-md-12" role="alert">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="../images/<?php echo $a['image'] ?>" alt="" class="img-fluid col-md-8" />
                            </div>
                            <div class="col-md-3">
                                <h4 class="alert-heading"><?php echo $a['name']; ?></h4>
                                <span class="badge badge-primary"><?php echo $a['brand']; ?></span>
                                <span class="badge badge-secondary"><?php echo $a['code']; ?></span>
                                <span class="badge badge-success"><?php echo $a['category']; ?></span>
                                <span class="badge badge-danger"><?php echo $a['gender']; ?></span>
                                <span class="badge badge-warning"><?php echo $a['type']; ?></span>
                                <p class="mb-0">Price in INR: ₹<?php echo $a['price']; ?></p>
                            </div>
                            <div class="col-md-1 offset-4">
                                <span class="badge badge-success">Count: <?php echo $a['count']; ?></span>
                                <span class="badge badge-warning">Price: ₹<?php echo $a['count'] * $a['price'];
                                                                                    $total += $a['count'] * $a['price']; ?></span>
                                <a href="ship.php?id=<?php echo $a['id']; ?>"><span class="mt-4 badge badge-danger">Ship</span></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <hr>
    </body>
<?php } ?>

    </html>