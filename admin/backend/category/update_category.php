<?php
require_once '../../../classes/category.class.php';

if ($_POST) {
    $category = new Category();
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_currentImage = $_POST['old_image'];

    $category_newImage = $_FILES['new_image']['name'];
    $tempname = $_FILES['new_image']['tmp_name'];

    if ($category_newImage) {
        $file_extension = pathinfo($category_newImage, PATHINFO_EXTENSION);
        $new_file_name = uniqid('category_', true) . '_' . time() . '.' . $file_extension;
        $folder = '../../images/' . $new_file_name;
    }

    $name_check = $category->checkNameId($category_id, $category_name);
    if ($name_check) {
        $response = array(
            'status' => 'error',
            'message' => 'Category name already exists!',
        );
    } else {
        if ($category_newImage) {
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
                if ($category_currentImage && $category_currentImage !== $new_file_name) {
                    $old_image_path = '../../images/' . $category_currentImage;
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
            $updated_image = $category_currentImage;
        }

        $update_result = $category->updatecategory($category_id, $category_name, $updated_image);

        if ($update_result == 0) {
            $response = array(
                'status' => 'success',
                'message' => 'Category updated successfully!',
                'redirect' => 'categories.php',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Category not updated successfully!',
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
