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

    public function last() {

        if(isset($_SESSION["currentuser"])) {
            $this->view->setLayout("logged");
        }

        $products = $this->productMapper->listLast();
        $this->view->setVariable("products", $products);

        $this->view->render("products", "index");
    }

    public function create() {

        $product = new Product();

        if (isset($_POST["productname"])){

            $product->setName($_POST["name"]);
            $product->setDescription($_POST["description"]);
            $product->setPrice($_POST["price"]);
            $product->setTags($_POST["tags"]);
            $product->setAddDate($_POST["date"]);
            $product->setSeller($_POST["seller"]);


            try{
                $product->checkIsValidForRegister();

                if (!$this->productMapper->exists($_POST["productname"])){

                    $this->productMapper->save($product);
                    $this->view->setFlash("Product ".$product->getUsername()." successfully added. ");
                    //no se
                    //$this->view->redirect("users", "login");
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
        $this->view->setVariable("user", $product);

        // render the view (/view/users/register.php)
        $this->view->render("users", "register");
    }

    public function view() {

        if (!isset($_GET["id"])) {
            throw new Exception("id is mandatory");
        }

        $id = $_GET["id"];
        $products = $this->productMapper->view($id);
        $this->view->setVariable("product", $products);
        $this->view->render("products", "view");
    }

}