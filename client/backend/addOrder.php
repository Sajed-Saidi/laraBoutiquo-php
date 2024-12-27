<?php
session_start();
require_once "../../classes/cart.class.php";
require_once "../../classes/order.class.php";

if ($_POST) {
    $total_price = $_POST['total_price'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    if (isset($_SESSION['login'])) {
        $user_id = $_SESSION['user_id'];


        $order = new Order();
        $order_id = $order->insertOrder($user_id, $total_price, $country, $address, $phone);

        $cart = new Cart();
        $cartItems = $cart->getCartById($user_id);

        foreach ($cartItems as $cartItem) {
            $product_id = $cartItem['product_id'];
            $quantity = $cartItem['quantity'];
            $total_price = $cartItem['total_price'];

            $order->insertOrderItems($order_id, $product_id, $quantity, $total_price);
        }


        $cart->deleteCart($user_id);

        $response = array(
            'status' => 'success',
            'message' => 'Order placed successfully!',
            'redirect' => 'thankyou.php'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Order not successful. Please login first.',
        );
    }

    // Send the response as JSON
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
