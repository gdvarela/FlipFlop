<?php
//file: controller/BaseController.php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/ChatMapper.php");

/**
 * Class ChatController
 */
class ChatController
{
    public function createChat(){
        $id = $_POST["pid"];
        $u = $_SESSION["currentuser"];
        $o = $this->chatMapper->getOwner($id);

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