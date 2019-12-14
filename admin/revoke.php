<?php include 'connect.php' ?>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo '<script type="text/javascript">
                window.location = "login.php"
                 </script>';
}
else{
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "UPDATE dealer SET approved=0 WHERE id=".$id;
        if(mysqli_query($conn, $sql)){
            echo '<script type="text/javascript">
                    window.location = "unapproved.php"
                    </script>';
        }
    }
    else{
        echo '<script type="text/javascript">
                    window.location = "unapproved.php"
                    </script>';
    }
}
?>