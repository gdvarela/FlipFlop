<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

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
        $this->view->setLayout("welcome");
    }

    public function login() {
        if (isset($_POST["username"])){
            //process login form
            if ($this->userMapper->isValidUser($_POST["username"], $_POST["passwd"])) {

                $_SESSION["currentuser"]=$_POST["username"];
                $this->view->redirect("products", "index");

            }else{
                $errors = array();
                $errors["general"] = "User is not valid";
                $this->view->setVariable("errors", $errors);
            }
        }

        // render the view (/view/users/login.php)
        $this->view->render("users", "login");
    }

    public function register() {

        $user = new User();

        if (isset($_POST["login"])){

            $user->setName($_POST["name"]);
            $user->setLastname($_POST["lastname"]);
            $user->setPass($_POST["pass"]);
            $user->setDNI($_POST["dni"]);
            $user->setEmail($_POST["mail"]);
            $user->setLogin($_POST["login"]);
            $user->setLogin($_POST["phone"]);

            try{
                $user->checkIsValidForRegister();

                if (!$this->userMapper->usernameExists($_POST["username"])){

                    $this->userMapper->save($user);
                    $this->view->setFlash("Username ".$user->getUsername()." successfully added. Please login now");
                    $this->view->redirect("users", "login");
                } else {
                    $errors = array();
                    $errors["username"] = "Username already exists";
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



    /**
     * Action to logout
     *
     * This action should be called via GET
     *
     * No HTTP parameters are needed.
     *
     * The views are:
     * <ul>
     * <li>users/login (via redirect)</li>
     * </ul>
     *
     * @return void
     */
    public function logout() {
        session_destroy();

        // perform a redirection. More or less:
        // header("Location: index.php?controller=users&action=login")
        // die();
        $this->view->redirect("users", "login");

    }

}