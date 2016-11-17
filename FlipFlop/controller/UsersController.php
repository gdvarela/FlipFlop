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
        $this->userMapper = new UserMapper();
        $this->view->setLayout("header");
    }

    public function login() {


        if (isset($_POST["login"])){

            if($this->userMapper->isValidUser($_POST["login"])) {
                $user = $this->userMapper->isValidPass($_POST["login"], $_POST["pass"]);

                if (isset($user[0]["id"])) {
                    $_SESSION["currentuser"] = $user[0]["id"];
                    $_SESSION["currentuserName"] = $user[0]["name"];
                }else{

                    $_SESSION["ERRORS"]["login"] = $_POST["login"];
                    $this->view->setFlash("Password is not valid");
                }
            } else {
                $this->view->setFlash("User is not valid");
            }

            $this->view->redirect("products", "last");
        }
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
        $this->view->setVariable("user", $user);

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

        $this->view->redirect("products", "last");
    }

}
