<?php include 'connect.php' ?>
<?php
$name = $owner = $email = $phone = $password = $location = $address = $bio = $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flag = 0;
    $name = $_POST['name'];
    $owner = $_POST['owner'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = $_POST['location'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];
    $select_query = "SELECT * FROM dealer";
    $result = mysqli_query($conn, $select_query);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email) {
            $flag = 1;
            $error = "User already exists";
        }
    }
    if (
        empty($_POST['name']) || empty($_POST['owner']) || empty($_POST['email']) || empty($_POST['phone']) ||
        empty($_POST['password']) || empty($_POST['location']) || empty($_POST['address']) || empty($_POST['bio'])
    ) {
        $error = "Please fill in all the details";
        $flag == 1;
    }
    if ($flag == 0) {
        $sql = "INSERT INTO dealer (name, owner, email, password, location, address, phone, bio, approved) 
        VALUES ('$name', '$owner', '$email', '$password', 'location', '$address', '$phone', '$bio', 0)";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">
                    window.location = "login.php"
                    </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>
        Sign up - Dealer
    </title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Online Watch Store</a>
        <a href="../user/" class="ml-auto mr-3"><button class="btn btn-outline-primary">I'm a user</button></a>
        <a href="login.php" class="mr-3"><button class="btn btn-outline-primary">Login</button></a>
    </nav>
    <div class="container">
        <h2 class=" col-md-4 text-center mt-2 mx-auto">Dealer Sign-up</h2>
        <form action="" method="POST" class="col-md-8 mx-auto mt-5 px-2 py-2 border border-dark rounded">
            <span class="error"><?php echo $error; ?></span>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Owner's name</label>
                <input type="text" class="form-control" name="owner">
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label>Bussiness phone</label>
                <input type="text" class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" name="location">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="textarea" class="form-control" name="address">
            </div>
            <div class="form-group">
                <label>Short bio</label>
                <input type="textarea" class="form-control" name="bio">
            </div>
            <input type="submit" name="submit" value="Sign up" class="btn btn-block btn-primary">
        </form>
        <br>
    </div>
</body>

</html>