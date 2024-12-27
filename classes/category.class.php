<?php
require_once "DAL.class.php";

class Category extends DAL
{

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->getData($sql);
    }

    public function insertCategory($category_name, $category_image)
    {
        $sql = "INSERT INTO categories (category_name,category_image) VALUES ('$category_name','$category_image')";
        return $this->execute($sql);
    }
    public function updatecategory($category_id, $category_name, $category_image)
    {
        $sql = "UPDATE categories SET category_name= '$category_name',category_image='$category_image'  WHERE category_id= '$category_id'";
        return $this->execute($sql);
    }
    public function deleteCategory($category_id)
    {
        $sql = "DELETE FROM categories WHERE category_id='$category_id'";
        return $this->execute($sql);
    }
    public function checkCategoryName($category_name)
    {
        $sql = "SELECT * FROM categories WHERE category_name='$category_name'";
        return $this->getData($sql);
    }
    public function checkNameId($category_id, $category_name)
    {
        $sql = "SELECT * FROM categories WHERE category_name='$category_name' AND category_id != $category_id";
        return $this->getData($sql);
    }
    public function hasProducts($category_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = $category_id";
        $result = $this->getData($sql);
        return !empty($result);
    }
}
