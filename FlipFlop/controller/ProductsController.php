<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Product.php");
require_once(__DIR__."/../model/ProductMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ProductsController extends BaseController {

    private $productMapper;

    public function __construct() {
        parent::__construct();

        $this->productMapper = new ProductMapper();

        $this->view->setLayout("header");
    }

    public function create() {
        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Adding posts requires login");
        }

        $product = new Product();

        if (isset($_POST["submit"])){

            $product->setProductName($_POST["name"]);
            $product->setDescription($_POST["description"]);
            $product->setPrice($_POST["price"]);
            $product->setTags($_POST["tags"]);
            $product->setAddDate( CURDATE() );
            $product->setSeller($_POST["seller"]);


            try{
                $product->checkIsValidForRegister();

                if (!$this->productMapper->exists($_POST["name"])){

                    $this->productMapper->save($product);
                    $this->view->setFlash("Product ".$product->getProductName()." successfully added. ");
                    $this->view->redirect("products", "index");

                } else {
                    $errors = array();
                    $errors["product"] = "product already exists";
                    $this->view->setVariable("errors", $errors);
                }
            }catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }

        // Put the User object visible to the view
        $this->view->setVariable("product", $product);

        // render the view (/view/products/add.php)
        $this->view->render("products", "add");
    }

    public function view() {

        if (!isset($_GET["id"])) {
            throw new Exception("id is mandatory");
        }

        $id = $_GET["id"];
        $product = $this->productMapper->view($id);
        $this->view->setVariable("product", $product);
        $this->view->render("products", "view");
    }

}