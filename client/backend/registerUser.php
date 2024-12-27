<?php
require_once '../../classes/user.class.php';

if ($_POST) {
    $user = new User();

    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name_check = $user->checkUserName($user_name);
    if ($name_check) {
        $response = array(
            'status' => 'error',
            'message' => 'Username already exist!',
        );
    } else {
        if ($password !== $confirm_password) {
            $response = array(
                'status' => 'error',
                'message' => 'Confirm password doesn`t match the password!'
            );
        } else {
            $insert_result = $user->registerUser($user_name, $email, password_hash($password, PASSWORD_BCRYPT));
            if ($insert_result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Registered Successfully!',
                    'redirect' => 'index.php'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Regestration is not Successful!',
                );
            }
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
