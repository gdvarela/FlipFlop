<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/Message.php");
require_once(__DIR__ . "/../model/Chat.php");

require_once(__DIR__ . "/../controller/BaseController.php");


class AJAXController extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function messages()
    {
        $chat = array();
        if ($this->chatMapper->checkChatOwner($_POST['idChat'], $_SESSION['currentuser'])) {
            array_push($chat, $this->chatMapper->getChatInfo($_POST['idChat']));
            array_push($chat, $this->chatMapper->getMessages($_POST['idChat'], $_POST['last']));
        }

        echo json_encode($chat);
    }

    public function send()
    {
        if ($this->chatMapper->checkChatOwner($_POST['idChat'], $_SESSION['currentuser'])) {
            $msg = new Message($_POST["idChat"], null, $_POST["msg"], $_SESSION["currentuser"], $_POST["time"]);
            $this->chatMapper->saveMsg($msg);
        }
    }
}