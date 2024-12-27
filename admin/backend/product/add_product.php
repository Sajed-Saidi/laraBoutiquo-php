<?php
require_once '../../../classes/product.class.php';

if ($_POST) {
    $product = new Product();
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $category_id = $_POST['category_id'];
    $file_name = $_FILES['product_image']['name'];
    $tempname = $_FILES['product_image']['tmp_name'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_file_name = uniqid('product_', true) . '_' . time() . '.' . $file_extension;
    $folder = '../../images/' . $new_file_name;
    $name_check = $product->checkProductName($product_name);

    if ($name_check) {
        $response = array(
            'status' => 'error',
            'message' => 'Product name already exist!',
        );
    } else {
        if (move_uploaded_file($tempname, $folder)) {
            $insert_result = $product->insertProduct($product_name, $new_file_name, $product_description, $product_price, $product_quantity, $category_id);
            if ($insert_result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Product Added Successfully!',
                    'redirect' => 'products.php'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Product Not Added Successfully!',
            );
        }
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
