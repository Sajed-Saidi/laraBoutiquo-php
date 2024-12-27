<?php
session_start();
require_once "../../classes/cart.class.php";
require_once "../../classes/product.class.php";

if ($_POST) {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    if (isset($_SESSION['login'])) {
        $user_id = $_SESSION['user_id'];
        $quantity = 1;
        $total_price = $product_price * $quantity;
        $cart = new Cart();
        $cart->insertToCart($user_id, $product_id, $product_price, $quantity, $total_price);
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
