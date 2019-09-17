<?php include 'connect.php'?>
<?php session_start();
if (!isset($_SESSION['dealer'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
}
else{
    $dealer_id = $_SESSION['dealer'];
    $sql = "SELECT * FROM products WHERE dealer_id='$dealer_id'";
    $result = mysqli_query($conn, $sql);  
    while($row = mysqli_fetch_assoc($result)){
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
        <div class="row mx-1">
        <h2 class= "col-md-12 mt-2">Product List</h2>
        <div class="col-md-12">
            <?php foreach($data as $a){?> 
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><?php echo $a['name']; ?></h4>
                <p><?php echo $a['description']; ?></p>
                <span class="badge badge-primary"><?php echo $a['brand']; ?></span>
                <span class="badge badge-secondary"><?php echo $a['code']; ?></span>
                <span class="badge badge-success"><?php echo $a['category']; ?></span>
                <span class="badge badge-danger"><?php echo $a['gender']; ?></span>
                <span class="badge badge-warning"><?php echo $a['type']; ?></span>
                <hr>
                <p class="mb-0">Price in INR: <?php  echo $a['price']; ?></p>
            </div>
            <?php } ?>
        </div>
    </div>

</body>
<?php } ?>
</html>