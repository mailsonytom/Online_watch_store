<?php include 'connect.php' ?>
<?php
    $firstname = $lastname = $username = $password = $address = $phone = $altphone = $offaddress = $gender = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['ph_no'];
        $altphone = $_POST['alt_ph'];
        $address = $_POST['address'];
        $offaddress = $_POST['off_address'];
        $gender = $_POST['gender'];
        $select_query = "SELECT * FROM user_details";
    $result = mysqli_query($conn, $select_query);
    while($row=mysqli_fetch_assoc($result)){
        if($row['email'] == $username){
        $flag = 1;
            echo '<script type="text/javascript">
                    window.location = "user_duplicate_error.php"
                    </script>';
        }
    }
    if($flag == 0){
        $sql = "INSERT INTO user_details (first_name, last_name, email_id, password, phone, alt_phone, address ,off_address, gender) VALUES ('$firstname', '$lastname', '$username', '$password', '$phone', 'altphone', '$address',  'offaddress', 'gender')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">
                    window.location = "login.html"
                    </script>';
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
}

?>