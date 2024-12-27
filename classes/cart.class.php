<?php
require_once "DAL.class.php";

class cart extends DAL
{
    public function insertToCart($user_id, $product_id, $price, $quantity, $total_price)
    {
        $sql = "INSERT INTO cart (user_id,product_id,price,quantity,total_price) VALUES ('$user_id','$product_id','$price','$quantity','$total_price')";
        return $this->execute($sql);
    }
    public function isProductInCart($user_id, $product_id)
    {
        $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $result = $this->getData($sql);
        return !empty($result);
    }
    public function getCartById($user_id)
    {
        $sql = "SELECT * FROM cart WHERE user_id= '$user_id'";
        return $this->getData($sql);
    }
    public function deleteCartItem($user_id, $product_id)
    {
        $sql = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        return $this->execute($sql);
    }
    public function deleteCart($user_id)
    {
        $sql = "DELETE FROM cart WHERE user_id = '$user_id' ";
        return $this->execute($sql);
    }
    public function updateCart($user_id, $product_id, $quantity, $total_price)
    {
        $sql = "UPDATE cart SET quantity= '$quantity',  total_price=' $total_price' WHERE user_id = '$user_id' AND product_id = '$product_id'";
        return $this->execute($sql);
    }
}
