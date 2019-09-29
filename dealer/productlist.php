<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
} else {
    $limit = 3;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $dealer_id = $_SESSION['dealer'];
    $sql = "SELECT * FROM products WHERE dealer_id='$dealer_id' LIMIT $start_from, $limit";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>
            Online Watch Store | Products 
        </title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Online Watch Store</a>
            <a href="dashboard.php" class="ml-auto mr-3"><button class="btn btn-outline-info">Back to dashboard</button></a>
            <a href="addnew.php" class="mr-3"><button class="btn btn-outline-info">Add new product</button></a>
            <a href="logout.php" class="mr-3"><button class="btn btn-outline-primary">Logout</button></a>
        </nav>
        <div class="container">
            <div class="row mx-1">
                <h2 class="col-md-12 mt-2">Product List</h2>
                <div class="col-md-12">
                    <?php foreach ($data as $a) { ?>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading"><?php echo $a['name']; ?></h4>
                            <p><?php echo $a['description']; ?></p>
                            <span class="badge badge-primary"><?php echo $a['brand']; ?></span>
                            <span class="badge badge-secondary"><?php echo $a['code']; ?></span>
                            <span class="badge badge-success"><?php echo $a['category']; ?></span>
                            <span class="badge badge-danger"><?php echo $a['gender']; ?></span>
                            <span class="badge badge-warning"><?php echo $a['type']; ?></span>
                            <span class="badge badge-info"><?php echo $a['count']; ?> pieces remaining</span>
                            <hr>
                            <p class="mb-0">Price in INR: <?php echo $a['price']; ?></p>
                            <a href="updatecount.php?id=<?php echo $a['id']; ?>"><button class="btn btn-primary mt-2">Update inventory</button></a>
                        </div>
                    <?php } ?>
                </div>
                <?php
                    $sql = "SELECT COUNT(id) FROM products WHERE dealer_id='$dealer_id'";
                    $rs_result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_row($rs_result);
                    $total_records = $row[0];
                    $total_pages = ceil($total_records / $limit);
                    $pagLink = "<div class='pagination mt-3'>";
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $pagLink .= "<li class='page-item'><a class='page-link' href='productlist.php?page=" . $i . "'>" . $i . "</a></li>";
                    };
                    echo $pagLink . "</div>";
                    ?>
            </div>

    </body>
<?php } ?>

    </html>