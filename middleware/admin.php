<?php
session_start();
if (!isset($_SESSION['login']) || (isset($_SESSION['login']) && $_SESSION['role'] != "admin")) {
    header("Location:../client/index.php");
    exit();
}
