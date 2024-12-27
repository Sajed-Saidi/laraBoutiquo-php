<?php
require_once "DAL.class.php";

class Order extends DAL
{
    public function getAllOrder()
    {
        $sql = "SELECT * FROM orders";
        return $this->getData($sql);
    }

    public function insertOrder($user_id, $total_price, $country, $address, $phone)
    {
        $sql = "INSERT INTO orders (user_id, total_price, country, address, phone) 
                VALUES ('$user_id', '$total_price', '$country', '$address', '$phone')";
        return $this->execute($sql);
    }
    public function insertOrderItems($order_id, $product_id, $quantity, $total_price)
    {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, total_price) 
                VALUES ( '$order_id', '$product_id', '$quantity', '$total_price')";
        return $this->execute($sql);
    }
    public function getOrderItems($order_id)
    {
        $sql = "SELECT * FROM order_items WHERE order_id = '$order_id'";
        return $this->getData($sql);
    }
    public function getOrderById($order_id)
    {
        $sql = "SELECT * from orders WHERE order_id='$order_id'";
        return $this->getdata($sql);
    }
    public function updateStatus($order_id, $order_status)
    {
        $sql = "UPDATE orders SET order_status='$order_status' where order_id='$order_id'";
        return $this->execute($sql);
    }
}
