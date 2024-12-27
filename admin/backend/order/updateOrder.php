<?php
require("../../../classes/order.class.php");

$orders = new Order();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $orders->updateStatus($order_id, $order_status);

    $response = array(
        'status' => 'success',
        'message' => 'Order updated successfully.'
    );
    echo json_encode($response);
} else {
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Something went wrong.'
    ));
}
