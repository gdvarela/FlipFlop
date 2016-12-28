<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Product.php");
require_once(__DIR__."/../model/ProductMapper.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ProductsController extends BaseController {

    private $productMapper;
    private $userMapper;

    public function __construct() {
        parent::__construct();

        $this->productMapper = new ProductMapper();
        $this->userMapper = new UserMapper();
    }

    /**
     *
     */
    public function add() {

//        if (!isset($this->currentUser)) {
//            throw new Exception("Not in session. Adding posts requires login");
//        }

        $product = new Product();

        if (isset($_POST["submit"])){

            $product->setProductName($_POST["name"]);
            $product->setDescription($_POST["description"]);
            $product->setPrice($_POST["price"]);
            $product->setTags($_POST["tags"]);
            $product->setAddDate( date('Y-m-d', time()) );
            $product->setSeller($_SESSION["currentuser"]);

            try{
                $product->checkIsValidForRegister();

                if (!$this->productMapper->exists($_POST["name"])){

                    $this->productMapper->save($product);
                    $pid = $this->productMapper->pid($_POST["name"]);

                    if($_FILES["files"]["name"]=""){
                        $cont = 0;
                        //Subimos las fotos
                        for($cont; $cont <= count($_FILES['files']['name']); $cont++) {
                            $foto = $_FILES['files']['tmp_name'][$cont];
                            $nombre = $_FILES['files']['name'][$cont];
                            $extension = pathinfo($nombre, PATHINFO_EXTENSION);
                            $newname = $pid . $cont . "." . $extension;
                            $destino = "resources/" . $newname;
                            move_uploaded_file($foto, $destino);
                            $this->productMapper->saveImg($pid . $cont, $pid);
                            if ($cont == 2) break;
                        }
                    }

                    $this->view->setFlash("Product ".$product->getProductName()." successfully added. ");
                    $this->view->redirect("users", "profile");

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

        // Put the product object visible to the view
        $this->view->setVariable("product", $product);

        // render the view (/view/products/add.php)
        $this->view->render("products", "add");
    }

    public function view(){
        if (!isset($_GET["id"])) {
            throw new Exception("id is mandatory");
        }

        $id = $_GET["id"];

        // find the Product object in the database
        $product = $this->productMapper->view($id);
        $product->setSeller($this->productMapper->getSeller($id));
        $uri[] = $this->productMapper->getUri($id);

        if ($product == NULL) {
            throw new Exception("no such product with id: ".$id);
        }

        // put the Post object to the view
        $this->view->setVariable("product", $product);
        $this->view->setVariable("uri", $uri);

        // render the view (/view/products/view.php)
        $this->view->render("products", "view");

    }

    public function edit() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("A product id is mandatory");
        }

        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Editing posts requires login");
        }


        // Get the Post object from the database
        $id = $_REQUEST["id"];
        $product = $this->productMapper->view($id);

        // Does the post exist?
        if ($product == NULL) {
            throw new Exception("no such product with id: ".$id);
        }

        // Check if the Post author is the currentUser (in Session)
        if ($product->getSeller() != $_SESSION["currentuser"]) {
            throw new Exception("logged user is not related with the product id ".$id);
        }

        if (isset($_POST["submit"])) { // reaching via HTTP Product...

            // populate the Product object with data form the form
            $product->setDescription($_POST["description"]);
            $product->setPrice($_POST["price"]);
            $product->setTags($_POST["tags"]);

            try {
                // validate Post object
                $product->checkIsValidForUpdate(); // if it fails, ValidationException

                // update the Post object in the database
                $this->productMapper->update($product);
                $this->view->setFlash(sprintf(i18n("Product \"%s\" successfully updated."),$product->getProductName()));

                // perform the redirection. More or less:
                // header("Location: index.php?controller=posts&action=index")
                // die();
                $this->view->redirect("users", "profile");

            }catch(ValidationException $ex) {
                // Get the errors array inside the exepction...
                $errors = $ex->getErrors();
                // And put it to the view as "errors" variable
                $this->view->setVariable("errors", $errors);
            }
        }

        // Put the Post object visible to the view
        $this->view->setVariable("product", $product);

        // render the view (/view/products/add.php)
        $this->view->render("products", "edit");
    }

    public function search()
    {
        $search = $_POST["searchbox"];

        $results = $this->productMapper->search($search);

        if ($results == NULL) {
            $this->view->setFlash(sprintf(i18n("nores")));
            $this->view->render("layouts", "default");

        }else{

            $this->view->setVariable("results", $results);
            $this->view->render("products", "results");

        }
    }

    public function delete(){

        if (!isset($_REQUEST["id"])) {
            throw new Exception("A product id is mandatory");
        }

        if (!isset($this->currentUser)) {
            throw new Exception("Not in session. Editing posts requires login");
        }

        // Get the Post object from the database
        $id = 2;
        $this->productMapper->delete($id);

    }

//    public function listFromUser($id){
//        $products = $this->productMapper->listFromUser();
//        $this->view->setVariable("products", $products);
//    }

}