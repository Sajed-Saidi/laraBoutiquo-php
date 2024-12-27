<?php
require_once '../../../classes/user.class.php';

if ($_POST) {
    $user = new User();
    $user_id = $_POST['update_pass_id'];
    $old_password_database = $user->getUserById($user_id)[0]['password'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $response = array(
            'status' => 'error',
            'message' => 'Confirm password doesn`t match the new password!'
        );
    } else {
        if (!password_verify($old_password, $old_password_database)) {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid old Password!'
            );
        } else {
            if ($old_password === $new_password) {
                $response = array(
                    'status' => 'error',
                    'message' => 'New password should be different than the old one!'
                );
            } else {
                $user->updatePassword($user_id, password_hash($new_password, PASSWORD_BCRYPT));
                $response = array(
                    'status' => 'success',
                    'message' => 'Password Updated Successfully!',
                    'redirect' => 'users.php',
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
