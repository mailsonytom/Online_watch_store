<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    if (isset($_GET['id'])) {
        $cart_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];
        $checksql = "SELECT count FROM cart WHERE id='$cart_id'";
        $checkresult = mysqli_query($conn, $checksql);
        $count = mysqli_fetch_assoc($checkresult)['count'];
        if ($count > 1) {
            $count = $count - 1;
            $sql = "UPDATE cart SET count='$count' WHERE id='$cart_id'";
        } else {
            $sql = "DELETE FROM cart WHERE id='$cart_id'";
        }
    }
    mysqli_query($conn, $sql);
    echo '<script type="text/javascript">
                    window.location = "cart.php"
                     </script>';
}
?>
