<?php
//Placed on pages which only admin and above can view
echo $_SESSION['permission'];
if ($_SESSION['permission'] < 4) {
    header("Location:login.php");
}
?>