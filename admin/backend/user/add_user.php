<?php
require_once '../../../classes/user.class.php';

if ($_POST) {
    $user = new User();
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $role = $_POST['role'];
    $name_check = $user->checkUserName($user_name);
    if ($name_check) {
        $response = array(
            'status' => 'error',
            'message' => 'Username already exist!',
        );
    } else {
        $insert_result = $user->insertUser($user_name, $email, $password, $role);
        if ($insert_result) {
            $response = array(
                'status' => 'success',
                'message' => 'User Added Successfully!',
                'redirect' => 'users.php'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'User Not Added Successfully!',
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
