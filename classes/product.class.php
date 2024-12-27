<?php
require_once "DAL.class.php";

class product extends DAL
{
    public function getAllProducts()
    {
        $sql = "SELECT p.product_id, p.product_name, p.product_image, p.product_description, p.product_price, p.product_quantity,p.category_id, c.category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.category_id";
        return $this->getData($sql);
    }
    public function insertProduct($product_name, $product_image, $product_description, $product_price, $product_quantity, $category_id)
    {
        $sql = "INSERT INTO products (product_name,product_image,product_description,product_price,product_quantity,category_id) VALUES ('$product_name','$product_image','$product_description','$product_price','$product_quantity','$category_id')";
        return $this->execute($sql);
    }
    public function updateProduct($product_id, $product_name, $product_image, $product_description, $product_price, $product_quantity, $category_id)
    {
        $sql = "UPDATE products SET product_name= '$product_name',product_image='$product_image',product_description='$product_description',product_price='$product_price',product_quantity='$product_quantity',category_id='$category_id'  WHERE product_id= '$product_id'";
        return $this->execute($sql);
    }
    public function deleteProduct($product_id)
    {
        $sql = "DELETE FROM products WHERE product_id='$product_id'";
        return $this->execute($sql);
    }
    public function checkProductName($product_name)
    {
        $sql = "SELECT * FROM products WHERE product_name='$product_name'";
        return $this->getData($sql);
    }
    public function checkNameId($product_id, $product_name)
    {
        $sql = "SELECT * FROM products WHERE product_name='$product_name' AND product_id != $product_id";
        return $this->getData($sql);
    }
    public function getProductsByCreatedAt()
    {
        $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 10;";
        return $this->getData($sql);
    }
    public function getRandomProducts()
    {
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 6;";
        return $this->getData($sql);
    }
    public function getProductById($product_id)
    {
        $sql = "SELECT * FROM products WHERE product_id='$product_id'";
        return $this->getData($sql);
    }

    public function getPaginatedProducts($page = 1, $limit = 6, $selected_categories = [], $search_query = '')
    {
        $offset = ($page - 1) * $limit;
        $category_condition = '';
        $search_condition = '';

        if (!empty($search_query)) {
            $search_condition = " AND (p.product_name LIKE '%$search_query%' OR p.product_description LIKE '%$search_query%')";
        }

        if (!empty($selected_categories)) {
            $categories = implode("','", $selected_categories);
            $category_condition = " AND c.category_name IN ('$categories')";
        }

        $sql = "SELECT p.product_id, p.product_name, p.product_image, p.product_description, p.product_price, p.product_quantity, p.category_id, c.category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.category_id
            WHERE 1=1 $category_condition $search_condition
            LIMIT $offset, $limit";
        return $this->getData($sql);
    }

    public function getTotalProductsCount($selected_categories = [], $search_query = '')
    {
        $category_condition = '';
        $search_condition = '';

        if (!empty($search_query)) {
            $search_condition = " AND (p.product_name LIKE '%$search_query%' OR p.product_description LIKE '%$search_query%')";
        }

        if (!empty($selected_categories)) {
            $categories = implode("','", $selected_categories);
            $category_condition = " AND c.category_name IN ('$categories')";
        }

        $sql = "SELECT COUNT(*) AS total FROM products p
            LEFT JOIN categories c ON p.category_id = c.category_id
            WHERE 1=1 $category_condition $search_condition";
        $result = $this->getData($sql);
        return $result[0]['total'];
    }

    public function getBestSelling()
    {
        $sql = "SELECT
                    p.*,
                    c.category_name,
                    COUNT(*) as count_product
                FROM
                    products p
                LEFT JOIN categories c ON
                    p.category_id = c.category_id
                INNER JOIN order_items o ON
                    o.product_id = p.product_id
                    GROUP BY p.product_id
                    ORDER BY count_product DESC
                    LIMIT 10
                        ";
        return $this->getData($sql);
    }
}
