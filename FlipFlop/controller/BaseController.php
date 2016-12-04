<?php
//file: controller/BaseController.php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/ChatMapper.php");

/**
 * Class BaseController
 *
 * Implements a basic super constructor for
 * the controllers in the Blog App.
 * Basically, it provides some protected
 * attributes and view variables.
 *
 * @author lipido <lipido@gmail.com>
 */
class BaseController
{

    /**
     * The view manager instance
     * @var ViewManager
     */
    protected $view;

    /**
     * The current user instance
     * @var User
     */
    protected $currentUser;
    public $chatMapper;
    public $user;

    public function __construct()
    {

        $this->view = ViewManager::getInstance();
        $this->chatMapper = new ChatMapper();

        // get the current user and put it to the view
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        $this->user = new User();
        $this->view->setVariable("user", $this->user);

        $this->view->deleteFlash();
        $this->view->setLayout("header");

        if (isset($_SESSION["currentuser"])) {
            $this->currentUser = new User($_SESSION["currentuser"]);
            $this->view->setVariable("currentusername", $this->currentUser->getLogin());

            $_SESSION["currentuserchats"] = $this->chatMapper->getUserChats($_SESSION["currentuser"]);

            $this->view->setLayout("logged");
        }
    }

    public function createChat(){
        $id = $_POST["pid"];
        $u = $_SESSION["currentuser"];
        $o = $this->chatMapper->getOnwer($id);

        //var_dump($u,$o);
        //die();

        if($u != $o){
            if( $this->chatMapper->exists($id,$u) == 0){
                $this->chatMapper->create($id, $u);
            }
        }

        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}
