<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Product.php");

class ProductMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }


    public function save($product){
        $stmt = $this->db->prepare("INSERT INTO Products values (?,?,?,?,?,?)");
        $stmt->execute(array($product->getProductName(), $product->getDescription(),
            $product->getPrice(), $product->getTags(), $product->getAddDate(), $product->getSeller()));
    }


    public function view($id){
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute(array($id));
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if($product != null) {
            return new Product(
                $product["id"], $product["product_name"], $product["description"], $product["price"],
                $product["tags"], $product["add_date"], $product["seller"]);
        } else {
            return NULL;
        }
    }

    public function listLast() {

        $stmt = $this->db->query("Select * from products order by add_date desc limit 8");
        $last_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = array();

        foreach ($last_products as $product) {
            array_push($products, new Product($product["id"], $product["product_name"], $product["description"],
                $product["price"], $product["tags"], $product["add_date"]));
        }

        return $products;
    }
}