<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Product.php");

class ProductMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }


    public function save(Product $product){
        $stmt = $this->db->prepare("INSERT INTO Products (product_name, description, price, tags, add_date, seller) values (?,?,?,?,?,?)");
        $stmt->execute(array($product->getProductName(), $product->getDescription(),
            $product->getPrice(), $product->getTags(), $product->getAddDate(), $product->getSeller()));
    }

    public function update(Product $product){
        $stmt = $this->db->prepare("UPDATE Products SET description=?, price=?, tags=? WHERE id=?");
        $stmt->execute(array($product->getDescription(), $product->getPrice(), $product->getTags(), $product->getId()));
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

    public function delete(Product $product) {
        $stmt = $this->db->prepare("DELETE from products WHERE id=?");
        $stmt->execute(array($product->getId()));
    }

    public function listLast() {

        $stmt = $this->db->query("Select * from products, images where products.id = Images.idProduct group by id order by add_date desc limit 8");
        $last_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = array();

        foreach ($last_products as $product) {
            array_push($products, new Product($product["id"], $product["product_name"], $product["description"],
                $product["price"], $product["tags"], $product["add_date"], $product["seller"], $product["uri"]));
        }

        return $products;
    }

    public function listFromUser($seller) {

        $stmt = $this->db->query("Select * from products where id=? group by id order by add_date desc");
        $stmt->execute(array($seller));
        $last_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = array();

        foreach ($last_products as $product) {
            array_push($products, new Product($product["id"], $product["product_name"], $product["description"],
                $product["price"], $product["tags"], $product["add_date"], $product["uri"]));
        }

        return $products;
    }


    public function exists($name) {
        $stmt = $this->db->prepare("SELECT * FROM Products where product_name=?");
        $stmt->execute(array($name));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    public function saveImg($uri, $pid){
        $stmt = $this->db->prepare("INSERT INTO Images (uri, idProduct) values   (?,?)");
        $stmt->execute(array($uri, $pid));
    }

    public function pid($name) {
        $stmt = $this->db->prepare("SELECT id FROM Products where product_name=?");
        $stmt->execute(array($name));

        return $stmt->fetchColumn(0);
    }

    public function getSeller($id) {
        $stmt = $this->db->prepare("SELECT login FROM Users u,Products p where u.id=p.seller AND p.id=?");
        $stmt->execute(array($id));

        return $stmt->fetchColumn(0);
    }

    //returns uri to get images
    public function getUri($id) {
        $stmt = $this->db->prepare("SELECT uri FROM Images where idProduct=?");
        $stmt->execute(array($id));
        $uri = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $uri;
    }

    public function search($s){

        $stmt = $this->db->query("SELECT * FROM products WHERE product_name LIKE '$s%' ");
        $last_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = array();

        foreach ($last_products as $product) {
            array_push($products, new Product($product["id"], $product["product_name"], $product["description"],
                $product["price"], $product["tags"], $product["add_date"]));
        }

        return $products;

    }

}