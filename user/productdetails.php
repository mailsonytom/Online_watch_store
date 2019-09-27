<?php include 'connect.php'?>
<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
    }
    else{
        if(isset($_GET['id'])){
            $user_id = $_SESSION['user_id'];
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);  
            $row = mysqli_fetch_assoc($result);
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
            <h6 class="h6 text-danger">Welcome <?php echo $name;?></h6>
        </div>
        <div class="col-md-8">
            <h3 class="h3">Purchase your favourite watch</h3>
        </div>
        <div class="col-md-1 offset-3">
        <a href="cart.php">
        <button type="button" class="btn btn-warning">
            <img src="../assets/images/cart.png" class="img-fluid"/>
            <span class="badge badge-dark"><?php echo $cartnumber; ?></span>
        </button>
        </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="../images/<?php echo $row['image']?>" alt="" class="img-fluid"/>
        </div>
        <div class="col-md-8">
            <h1>Watch name: <?php echo $row['name']?></h1>
            <span>Brand: <?php echo $row['brand']?></span>
            <br>
            <span class="badge badge-secondary"><?php echo $row['gender']; ?></span>
            <span class="badge badge-primary"><?php echo $row['type']; ?></span>
            <p><?php echo $row['description']; ?></p>
        </div>
    </div>
</div>
<hr>
</body>
<?php }?>
</html>