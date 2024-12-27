<?php
require_once '../../classes/wishlist.class.php';

if ($_POST) {
    $wishlist = new Wishlist();
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];

    $delete_result = $wishlist->deletewishlistItem($user_id, $product_id);

    if ($delete_result == 0) {
        $response = array(
            'status' => 'success',
            'message' => 'Deleted Successfully!',
            'redirect' => 'wishlist.php'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Not deleted Successfully!',
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
