<?php
require_once '../../../classes/user.class.php';

if ($_POST) {
    $user = new User();
    $user_id = $_POST['user_id'];

    $delete_result = $user->deleteUser($user_id);

    if ($delete_result == 0) {
        $response = array(
            'status' => 'success',
            'message' => 'User deleted Successfully!',
            'redirect' => 'users.php'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'User Not deleted Successfully!',
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
