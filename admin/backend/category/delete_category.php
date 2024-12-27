<?php
require_once '../../../classes/category.class.php';

if ($_POST) {
    $category = new Category();
    $category_id = $_POST['category_id'];
    $category_image = $_POST['category_image'];

    if ($category->hasProducts($category_id)) {
        $response = array(
            'status' => 'error',
            'message' => 'Category has product cant be deleted!',
        );
    } else {
        $delete_result = $category->deleteCategory($category_id);

        if ($delete_result == 0) {
            unlink('../../images/' . $category_image);
            $response = array(
                'status' => 'success',
                'message' => 'Category deleted Successfully!',
                'redirect' => 'categories.php'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Category Not deleted Successfully!',
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
