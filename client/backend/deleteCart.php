<?php
require_once '../../classes/cart.class.php';

if ($_POST) {
    $cart = new Cart();
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];

    $delete_result = $cart->deleteCartItem($user_id, $product_id);

    if ($delete_result == 0) {
        $response = array(
            'status' => 'success',
            'message' => 'Cart deleted Successfully!',
            'redirect' => 'cart.php'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Cart Not deleted Successfully!',
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
