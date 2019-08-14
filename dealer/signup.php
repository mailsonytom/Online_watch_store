<?php include 'connect.php' ?>
<?php
    $firstname = $lastname = $username = $password = $busname = $phone = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $flag = 0;
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['email'];
        $password = $_POST['password'];
        $busname = $_POST['bussiness_name'];
        $phone = $_POST['ph_no'];
        $select_query = "SELECT * FROM dealer_details";
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
        $sql = "INSERT INTO dealer_details (first_name, last_name, email_id, password, busname, phone) VALUES ('$firstname', '$lastname', '$username', '$password', 'busname', '$phone')";
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