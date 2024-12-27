<?php
if (!isset($_SESSION['login'])) {
    header("Location:../client/index.php");
    $_SESSION['message'] = "Login to Proceed!";
    exit();
}
