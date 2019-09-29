<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    $dealer_id = $_SESSION['dealer'];
    $sql = "SELECT product_id, shipped, purchases.price, purchases.count, name, brand, code, category, gender, type, dealer_id 
    FROM purchases INNER JOIN products ON purchases.product_id = products.id WHERE dealer_id='$dealer_id' AND shipped=1";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
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
            <div class="row">
            <h2 class="col-md-12 mt-2">Shipped products list</h2>
                <?php $total = 0;
                    foreach ($data as $a) { ?>
                    <div class="alert alert-success col-md-12" role="alert">
                        <div class="row">
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
                                <span class="badge badge-warning">Total order value: ₹<?php echo $a['count'] * $a['price'];
                                                                                    $total += $a['count'] * $a['price']; ?></span>
                                <a href="ship.php?id=<?php echo $a['id']; ?>"><span class="mt-4 badge badge-danger">Ship</span></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <div>
    </body>
<?php } ?>

    </html>