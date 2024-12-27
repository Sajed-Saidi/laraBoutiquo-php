<?php
require_once '../../../classes/user.class.php';

if ($_POST) {
    $user = new User();
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $name_check = $user->checkNameId($user_id, $user_name);
    if ($name_check) {
        $response = array(
            'status' => 'error',
            'message' => 'User name already exists!',
        );
    } else {
        $update_result = $user->updateUser($user_id, $user_name, $email, $role);

        if ($update_result == 0) {
            $response = array(
                'status' => 'success',
                'message' => 'User updated successfully!',
                'redirect' => 'users.php',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'User not updated successfully!',
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
