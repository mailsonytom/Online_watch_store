<?php include 'connect.php'?>
<?php 
    session_start();
    if (!isset($_SESSION['dealer'])) {
        echo '<script type="text/javascript">
                    window.location = "login.php"
                     </script>';
    }
    else{
        if(isset($_GET['id'])){
            $id= $_GET['id'];
            $sql = "UPDATE purchases SET shipped=1 WHERE id='$id'";
            mysqli_query($conn, $sql); 
            echo '<script type="text/javascript">
                        window.location = "shipping.php"
                        </script>';

        }
    }
?>