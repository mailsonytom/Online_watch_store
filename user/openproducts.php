<?php include 'connect.php' ?>
<?php
$limit = 10;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;
$sql = "SELECT * FROM products LIMIT $start_from, $limit";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Purchase your favourite watch | OWS</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Online Watch Store</a>
        <a href="login.php" class="ml-auto mr-3"><button class="btn btn-outline-info">Login</button></a>
        <a href="signup.php"><button class="btn btn-outline-info">Sign up</button></a>
    </nav>
    <div class="container">
        <div class="jumbotron banner">
        </div>
        <div class="row">
            <?php foreach ($data as $a) { ?>
                <div class="col-md-3 col-sm-6">
                    <a href="productdetails.php?id=<?php echo $a['id']; ?>">
                        <div class="product-grid6 mt-3">
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
<?php
$sql = "SELECT COUNT(id) FROM products";
$rs_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
$pagLink = "<div class='pagination mt-3'>";
for ($i = 1; $i <= $total_pages; $i++) {
    $pagLink .= "<li class='page-item'><a class='page-link' href='products.php?page=" . $i . "'>" . $i . "</a></li>";
};
echo $pagLink . "</div>";
?>
</div>
<hr>
</body>

</html>