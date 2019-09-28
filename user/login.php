<?php include 'connect.php' ?>
<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        include 'logout.php';
    }
    else{
        $email = $password = $error = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if($row=mysqli_fetch_assoc($result)){
                if(password_verify($password, $row['password'])){
                    $_SESSION['user_id'] = $row['id'];
                    echo '<script type="text/javascript">
                    window.location = "products.php"
                    </script>';
                }
                else{
                        $error = "Wrong password";
                }
            }
            else{
                $error = "Wrong username";
                }
            }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>User login</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Online Watch Store</a>
        <a href="signup.php" class="ml-auto"><button class="btn btn-outline-info">Sign up</button></a>
    </nav>
    <div class="container">
        <div class="jumbotron banner">
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-5">Sign-in as user</h2>
                <p>
                    The watch store will enable the best available watches for you to purchase and see them online. 
                    <br><br>
                    You can add them to your cart and purchase them at your convenicene. 
                </p>
            </div>
            <div class="col-md-6 mt-5 p-3 border border-info rounded">
                <form action="" method="POST">
                <span class="error"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <input type="submit" value="Login" class="btn btn-secondary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>

