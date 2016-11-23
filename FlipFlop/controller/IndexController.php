<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserMapper.php");
require_once(__DIR__ . "/../model/Product.php");
require_once(__DIR__ . "/../model/ProductMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");

/**
 * Class UsersController
 */
class IndexController extends BaseController
{

    private $userMapper;
    private $productMapper;

    public function __construct()
    {
        parent::__construct();

        $this->userMapper = new UserMapper();
        $this->productMapper = new ProductMapper();

    }

    public function welcome()
    {

        $errors = array();

        if (isset($_POST["login"])) {

            $this->user->setName($_POST["name"]);
            $this->user->setLastname($_POST["lastname"]);
            $this->user->setPass($_POST["password"]);
            $this->user->setDNI($_POST["dni"]);
            $this->user->setEmail($_POST["email"]);
            $this->user->setLogin($_POST["login"]);
            $this->user->setPhone($_POST["phone"]);

            try {
                $this->user->checkIsValidForRegister($_POST["password2"]);

                if (!$this->userMapper->loginExists($_POST["login"])) {
                    $this->userMapper->save($this->user);
                    $errors["userLogin"] = $this->user->getLogin();

                } else {
                    $errors = array();
                    $errors["username"] = "Username already exists";
                    $this->view->setVariable("errors", $errors);
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $errors["loadRegister"] = "loadRegister";
            }
        }
        if (isset($_POST["userLogin"])) {

            if ($this->userMapper->isValidUser($_POST["userLogin"])) {
                $userLogin = $this->userMapper->isValidPass($_POST["userLogin"], $_POST["pass"]);

                if (isset($userLogin[0]["id"])) {
                    $this->view->setLayout("logged");
                    $_SESSION["currentuser"] = $userLogin[0]["id"];
                    $_SESSION["currentusername"] = $userLogin[0]["name"];
                } else {

                    $errors["userLogin"] = $_POST["userLogin"];
                    $this->view->setFlash("Password is not valid");
                }
            } else {
                $this->view->setFlash("User is not valid");
            }
        }

        $this->view->setVariable("user", $this->user);
        $this->view->setVariable("errors", $errors);

        $products = $this->productMapper->listLast();
        $this->view->setVariable("products", $products);

        $this->view->render("products", "index");

    }
}