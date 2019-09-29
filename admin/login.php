<?php include 'connect.php' ?>
<?php
session_start();
if (isset($_SESSION['admin'])) {
    include 'logout.php';
}
$username = $password = $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['id'];
            echo '<script type="text/javascript">
                window.location = "unapproved.php"
                 </script>';
        } else {
            $error = "Wrong password.";
        }
    } else {
        $error = "Wrong username.";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title>
        Administrator
    </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Online Watch Store</a>
        <a href="../user/" class="ml-auto mr-3"><button class="btn btn-outline-primary">I'm a user</button></a>
        <a href="../dealer/" class="mr-3"><button class="btn btn-outline-primary">Login as dealer</button></a>
    </nav>
    <div class="container">
        <h2 class=" col-md-4 mx-auto ">Sign-in as admin</h2>
        <form action="" method="POST" class="col-md-8 mx-auto mt-5 px-2 py-2 border border-dark rounded">
            <span class="error"><?php echo $error; ?></span>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <input type="submit" value="Submit" class="btn btn-block btn-secondary">
        </form>
    </div>
</body>

</html>