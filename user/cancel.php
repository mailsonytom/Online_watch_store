<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
} else {
    if (isset($_GET['id'])) {
        $purchase_id = $_GET['id'];
        $sql = "DELETE FROM purchases WHERE id='$purchase_id'";
        }
    }
    mysqli_query($conn, $sql);
    echo '<script type="text/javascript">
                    window.location = "purchases.php"
                     </script>';
?>
