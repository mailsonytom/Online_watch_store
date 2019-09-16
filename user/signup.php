<?php include 'connect.php' ?>
<?php
    $name = $email = $password = $address = $phone = $gender = $error = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $select_query = "SELECT email FROM users";
        $result = mysqli_query($conn, $select_query);
        while($row=mysqli_fetch_assoc($result)){
            if($row['email'] == $email){
            $error = "Email already exist";
            $flag = 1;
            }
        }       
    if($flag == 0){
        $sql = "INSERT INTO users (name, email, password, phone, address, gender) 
        VALUES ('$name', '$email', '$password', '$phone', '$address', '$gender')";
        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">
                    window.location = "comment.html"
                    </script>';
        } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
        <div class="row mx-1">
            <h2 class=" col-md-5 text-center mt-2 mx-auto"> User Sign up</h2>
            <div class="col-md-8 mx-auto mt-5 mb-3 px-2 py-2 border border-dark rounded">
                <form action="" method="POST">
                    <span class="error"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
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
                        <label>Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <input type="submit" name="submit" class="btn btn-block btn-secondary">
                </form>
            </div>
            <br>
        </div>
</body>
</html>