<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "login.php"
                 </script>';
} else {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>
            Add new watch
        </title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.min.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Online Watch Store</a>
            <a href="productlist.php" class="ml-auto mr-3   "><button class="btn btn-outline-info">See my products</button></a>
            <a href="shipping.php" class="mr-3"><button class="btn btn-outline-info">Pending shipping</button></a>
            <a href="logout.php" class="mr-3"><button class="btn btn-outline-info">Logout</button></a>
        </nav>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12">
                    <h4>Welcome to the dealer dashboard</h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="alert alert-info col-md-6">
                    <h4 class="alert-heading">Add a new product</h4>
                    <p>You can add new products in your arena to attract customers</p>
                    <a href="addnew.php" class="btn btn-success">Click here to add</a>
                </div>
                <div class="alert alert-info col-md-6">
                    <h4 class="alert-heading">List of added products</h4>
                    <p>You can see the list of products in your inventory</p>
                    <a href="productlist.php" class="btn btn-success">Click here to view</a>
                </div>

                <div class="alert alert-info col-md-6">
                    <h4 class="alert-heading">Pending shippings</h4>
                    <p>You can see the orders that are pending for shipping in your inventory</p>
                    <a href="shipping.php" class="btn btn-success">Click here to view</a>
                </div>

                <div class="alert alert-info col-md-6">
                    <h4 class="alert-heading">List of shipped orders</h4>
                    <p>You can see the list of orders you had shipped</p>
                    <a href="shipped.php" class="btn btn-success">Click here to view</a>
                </div>
            </div>
        </div>
        </div>
    </body>
<?php } ?>

    </html>