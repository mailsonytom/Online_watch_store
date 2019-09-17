<?php include 'connect.php'?>
<?php session_start();
    $dealer_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);  
    while($row = mysqli_fetch_assoc($result)){
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
            <h3 class="h3">Purchase your favourite watch</h3>
        </div>
        <div class="col-md-1 offset-3">
            <img src="../assets/images/cart.png" class="img-fluid"/>
        </div>
    </div>
    <div class="row">
        <?php foreach($data as $a){?>
        <div class="col-md-3 col-sm-6">
            <div class="product-grid6">
                <div class="product-image6 mt-5">
                    <a href="#">
                        <img class="pic-1 img-fluid" src="../images/<?php echo $a['image'];?>">
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="productdetails.php?id=<?php echo $a['id'];?>"><?php echo $a['name'];?></a></h3>
                    <div class="price">Price: <?php echo $a['image'];?></div>
                    <button class="btn btn-warning">Add to cart</button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<hr>
</body>
</html>