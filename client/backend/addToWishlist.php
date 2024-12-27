<?php
session_start();
require_once "../../classes/wishlist.class.php";
require_once "../../classes/product.class.php";

if ($_POST) {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    if (isset($_SESSION['login'])) {
        $user_id = $_SESSION['user_id'];
        $wishlist = new Wishlist();
        $wishlist->insertToWishlist($user_id, $product_id, $product_price);
        $response = array(
            'status' => 'success',
            'message' => 'added Successfully!',
            'redirect' => 'index.php'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'You have to login first',
        );
    }


    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Method Not POST!',
    );

    header('Content-Type: application/json');
    echo json_encode($response);
}
