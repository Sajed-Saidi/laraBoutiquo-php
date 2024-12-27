<?php
require_once '../../../classes/product.class.php';

if ($_POST) {
    $product = new Product();
    $product_id = $_POST['product_id'];
    $product_image = $_POST['product_image'];

    $delete_result = $product->deleteProduct($product_id);

    if ($delete_result == 0) {
        unlink('../../images/' . $product_image);
        $response = array(
            'status' => 'success',
            'message' => 'Product deleted Successfully!',
            'redirect' => 'products.php'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Product Not deleted Successfully!',
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
