<?php
session_start();

require_once "../../classes/DAL.class.php";
$dal = new DAL();

if ($_POST) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user_name = ?";
    $params = array($user_name);
    $result = $dal->data($sql, $params);

    if ($result && count($result) > 0) {
        $storedPasswordHash = $result[0]['password'];
        $role = $result[0]['role'];
        $user_id = $result[0]['user_id'];
        if (password_verify($password, $storedPasswordHash)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['role'] = $role;
            $_SESSION['login'] = true;

            $response = array(
                'status' => 'success',
                'message' => 'Login Successfully!',
                'redirect' => 'index.php'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Passwords Doesn`t Match.'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid name!',
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
