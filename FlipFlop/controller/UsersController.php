<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Product.php");
require_once(__DIR__."/../model/ProductMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class UsersController
 */

class UsersController extends BaseController {

    /**
     * @var UserMapper
     */
    private $userMapper;

    public function __construct() {
        parent::__construct();
        $this->userMapper = new UserMapper();
        $this->productMapper = new ProductMapper();
        $this->view->setLayout("header");
    }

    public function modify() {

        $user = new User();

        if (isset($_POST["login"])){

            $user->setLogin($_POST["login"]);
            $user->setName($_POST["newname"]);
            $user->setLastname($_POST["newlastname"]);
            $user->setPass($_POST["newpass"]);
            $user->setDNI($_POST["newdni"]);
            $user->setEmail($_POST["newmail"]);
            $user->setPhone($_POST["newphone"]);

            try{

                if (!$this->userMapper->usernameExists($_POST["username"])){

                    $this->userMapper->modify($user);
                    $this->view->setFlash("Username ".$user->getLogin()." successfully modified. Please login again now");
                    $this->view->redirect("users", "login");
                } else {
                    $errors = array();
                    $errors["username"] = "Error modifying user";
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
        $this->view->setVariable("user", $user);

        // render the view (/view/users/register.php)
        $this->view->render("users", "register");

    }

    public function logout() {
        session_destroy();

        $this->view->redirect("index", "welcome");
    }

}
