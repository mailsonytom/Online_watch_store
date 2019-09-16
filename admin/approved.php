<?php include 'connect.php'?>
<?php session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                window.location = "signin.php"
                 </script>';
}
else{
    $sql = "SELECT * FROM dealer WHERE approved=1";
    $result = mysqli_query($conn, $sql);  
    while($row = mysqli_fetch_assoc($result)){
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
    </nav>
    <div class="container">
        <div class="row mx-1">
        <h2 class= "col-md-12 mt-2">Approved dealers list</h2>
        <div class="col-md-12">
            <?php foreach($data as $a){?> 
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Name: <?php echo $a['name']; ?></h4>
                <span class="badge badge-primary"><?php echo $a['owner']; ?></span>
                <span class="badge badge-secondary"><?php echo $a['email']; ?></span>
                <span class="badge badge-success"><?php echo $a['phone']; ?></span>
                <span class="badge badge-danger"><?php echo $a['location']; ?></span>
                <hr>
                <p class="mb-0">Address: <?php  echo $a['address']; ?></p>
            </div>
            <?php } ?>
        </div>
    </div>

</body>
<?php } ?>
</html>