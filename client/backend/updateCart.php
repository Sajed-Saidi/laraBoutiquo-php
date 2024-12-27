<?php
session_start();
require_once "../../classes/cart.class.php";
require_once "../../classes/product.class.php";
if ($_POST) {
    var_dump($_POST);
    $product_id = (int) $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $product = new Product();
    $productDetails = $product->getProductById($product_id);
    $product_price = $productDetails[0]['product_price'];
    $product_totalQuantity =  $productDetails[0]['product_quantity'];
    var_dump($product_totalQuantity);
    if (isset($_SESSION['login'])) {
        $user_id = $_SESSION['user_id'];
        $total_price = $product_price * $quantity;
        $cart = new Cart();
        $cart->updateCart($user_id, $product_id, $quantity, $total_price);
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
