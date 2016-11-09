<?php
require_once(__DIR__."/../core/PDOConnection.php");


require_once(__DIR__."/../model/Product.php");

class ProductMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function listLast() {

        $stmt = $this->db->query("Select * from Products order by add_date desc limit 4");
        $last_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = array();

        foreach ($last_products as $product) {
            array_push($products, new Products($product["id"], $product["product_name"], $product["description"],
                $product["price"], $product["tags"], $product["add_date"]));
        }

        return $products;
    }
}