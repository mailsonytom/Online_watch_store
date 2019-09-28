<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        while ($commentrow = mysqli_fetch_assoc($commentresult)) {
            $data[] = $commentrow;
        }
        $flag = 0;
        if (empty($_POST['comment'])) {
            $flag = 1;
            $error = "Comment is necesary to submit";
        }
        if ($flag == 0) {
            $comment = $_POST['comment'];
            $insertsql = "INSERT INTO comments (user_id, product_id, comment) VALUES ('$user_id', '$product_id', '$comment')";
            mysqli_query($conn, $insertsql);
        }
    }
    if (isset($_GET['id'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = '$product_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $commentsql = "SELECT * FROM comments WHERE product_id = '$product_id' AND user_id='$user_id'";
        $commentresult = mysqli_query($conn, $commentsql);
        while ($commentrow = mysqli_fetch_assoc($commentresult)) {
            $data[] = $commentrow;
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
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Write a comment</label>
                            <textarea name="comment" class="form-control" placeholder="Write a comment"></textarea>
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