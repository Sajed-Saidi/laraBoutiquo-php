<?php
require_once '../../../classes/product.class.php';

if ($_POST) {
    $product = new Product();
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $category_id = $_POST['updateCategory_id'];
    $product_currentImage = $_POST['old_image'];
    $product_newImage = $_FILES['new_image']['name'];
    $tempname = $_FILES['new_image']['tmp_name'];

    if ($product_newImage) {
        $file_extension = pathinfo($product_newImage, PATHINFO_EXTENSION);
        $new_file_name = uniqid('product_', true) . '_' . time() . '.' . $file_extension;
        $folder = '../../images/' . $new_file_name;
    }

    $name_check = $product->checkNameId($product_id, $product_name);
    if ($name_check) {
        $response = array(
            'status' => 'error',
            'message' => 'Product name already exists!',
        );
    } else {
        if ($product_newImage) {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                $response = array(
                    'status' => 'error',
                    'message' => 'Invalid image format. Allowed formats are jpg, jpeg, png, and gif.',
                );
                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }

            if (move_uploaded_file($tempname, $folder)) {
                if ($product_currentImage && $product_currentImage !== $new_file_name) {
                    $old_image_path = '../../images/' . $product_currentImage;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
                $updated_image = $new_file_name;
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Failed to upload the new image!',
                );
                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        } else {
            $updated_image = $product_currentImage;
        }

        $update_result = $product->updateproduct($product_id, $product_name, $updated_image, $product_description, $product_price, $product_quantity, $category_id);

        if ($update_result == 0) {
            $response = array(
                'status' => 'success',
                'message' => 'Product updated successfully!',
                'redirect' => 'products.php',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Product not updated successfully!',
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
