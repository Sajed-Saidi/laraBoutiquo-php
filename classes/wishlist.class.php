<?php
require_once "DAL.class.php";

class wishlist extends DAL
{
    public function insertToWishlist($user_id, $product_id, $price)
    {
        $sql = "INSERT INTO wishlist (user_id,product_id,price) VALUES ('$user_id','$product_id','$price')";
        return $this->execute($sql);
    }
    public function isProductInwhishlist($user_id, $product_id)
    {
        $sql = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $result = $this->getData($sql);
        return !empty($result);
    }
    public function getWishlistById($user_id)
    {
        $sql = "SELECT * FROM wishlist WHERE user_id= '$user_id'";
        return $this->getData($sql);
    }
    public function deletewishlistItem($user_id, $product_id)
    {
        $sql = "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
        return $this->execute($sql);
    }
}
