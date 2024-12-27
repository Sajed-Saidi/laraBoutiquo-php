<?php
require_once '../../../classes/category.class.php';

if ($_POST) {
    $category = new Category();
    $category_name = $_POST['category_name'];
    $file_name = $_FILES['category_image']['name'];
    $tempname = $_FILES['category_image']['tmp_name'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_file_name = uniqid('category_', true) . '_' . time() . '.' . $file_extension;
    $folder = '../../images/' . $new_file_name;
    $name_check = $category->checkCategoryName($category_name);

    if ($name_check) {
        $response = array(
            'status' => 'error',
            'message' => 'Category name already exist!',
        );
    } else {
        if (move_uploaded_file($tempname, $folder)) {
            $insert_result = $category->insertCategory($category_name, $new_file_name);
            if ($insert_result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Category Added Successfully!',
                    'redirect' => 'categories.php'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Category Not Added Successfully!',
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
