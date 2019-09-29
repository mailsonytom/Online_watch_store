<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    $cardno = $expiry = $cvv = $error = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $flag = 0;
        if (empty($_POST['cardno']) || empty($_POST['expiry']) || empty($_POST['cvv'])) {
            $error = "Please fill in the card details";
            $flag == 1;
        }
        if ($flag == 0) {
            $datetoday = date("Y/m/d");
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT price, product_id, count FROM products INNER JOIN cart on cart.product_id = products.id WHERE user_id='$user_id'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            foreach ($data as $a) {
                $insertsql = "INSERT INTO purchases (product_id user_id, count, date, shipped, price) VALUES(" .
                    $a['product_id'] . "," . $user_id . "," . $a['count'] . "," . $datetoday . ", 0," . $a['price']
                    . ")";
                mysqli_query($conn, $insertsql);
            }
            mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
            echo '<script type="text/javascript">
                    window.location = "products.php"
                    </script>';
        }
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
            <div class="row mt-5 mb-3">
                <div class="col-md-8">
                    <h3 class="h3">Complete your payment</h3>
                </div>
            </div>
            <div class="row">
                <form action="" method="POST">
                    <label>Enter card number</label>
                    <input type="text" name="cardno" class="form-control" placeholder="Enter card nubmer" />
                    <label>Enter expiry date</label>
                    <input type="text" name="expiry" class="form-control" placeholder="MM/YY">
                    <label>Enter CVV</label>
                    <input type="password" name="cvv" class="form-control" placeholder="">
                    <input type="submit" value="Submit" class="btn btn-secondary mt-3">
                </form>

            </div>
        </div>
        <hr>
    </body>
<?php } ?>

    </html>