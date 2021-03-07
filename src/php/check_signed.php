<?php 
session_start();
if ($_SESSION['logged_in'] != TRUE) {
    header("location:/login.php");
}

if (empty($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = FALSE;
}
?>