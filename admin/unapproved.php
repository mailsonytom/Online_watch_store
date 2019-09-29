<?php include 'connect.php' ?>
<?php session_start();
if (!isset($_SESSION['admin'])) {
    echo '<script type="text/javascript">
                window.location = "login.php"
                 </script>';
} else {
    $sql = "SELECT * FROM dealer WHERE approved=0";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>
            Approve dealer
        </title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Online Watch Store</a>
            <a href="approved.php" class="ml-auto mr-3"><button class="btn btn-outline-info">Approved dealers list</button></a>
            <a href="logout.php" class="mr-3"><button class="btn btn-outline-primary">Logout</button></a>
        </nav>
        <div class="container">
            <div class="row mx-1">
                <h2 class="col-md-12 mt-2">Approve dealer</h2>
                <div class="col-md-12">
                    <?php foreach ($data as $a) { ?>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Name: <?php echo $a['name']; ?></h4>
                            <span class="badge badge-primary"><?php echo $a['owner']; ?></span>
                            <span class="badge badge-secondary"><?php echo $a['email']; ?></span>
                            <span class="badge badge-success"><?php echo $a['phone']; ?></span>
                            <span class="badge badge-danger"><?php echo $a['location']; ?></span>
                            <hr>
                            <p class="mb-0">Address: <?php echo $a['address']; ?></p>
                            <a href="approve.php?id=<?php echo $a['id']; ?>"><button class="btn btn-primary">Approve</button></a>
                        </div>
                    <?php } ?>
                </div>
            </div>

    </body>
<?php } ?>

    </html>