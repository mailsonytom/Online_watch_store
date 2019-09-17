<?php include 'connect.php' ?>
<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
    }
    else{
        if(isset($_GET['id'])){
            $product_id = $_GET['id'];
            $user_id = $_SESSION['user_id'];
            $checksql = "SELECT count FROM cart WHERE product_id='$product_id' AND user_id='$user_id'";
            $checkresult = mysqli_query($conn, $checksql);
            $count = mysqli_fetch_assoc($checkresult)['count'] + 1;
            echo mysqli_fetch_assoc($result)['count'];
            if(mysqli_num_rows($checkresult)>0){
                $sql = "UPDATE cart SET count='$count' WHERE product_id='$product_id'";
            }
            else{
                $sql = "INSERT INTO cart (user_id, product_id, count) VALUES ('$user_id', '$product_id', 1)";
            }
        }
        mysqli_query($conn, $sql); 
        echo '<script type="text/javascript">
                    window.location = "products.php"
                     </script>';
    }
?>
