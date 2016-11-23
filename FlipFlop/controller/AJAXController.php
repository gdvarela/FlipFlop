<?php

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");

require_once(__DIR__ . "/../model/Chat.php");
require_once(__DIR__ . "/../model/ChatMapper.php");

require_once(__DIR__ . "/../controller/BaseController.php");


class AJAXController extends BaseController
{

    private $chatMapper;

    public function __construct()
    {
        parent::__construct();

        $this->chatMapper = new ChatMapper();
    }

    public function chats()
    {
        $chats = $this->chatMapper->getChats($_POST['idUsr']);

    }

    public function messages()
    {
        $chat = $this->chatMapper->getMessages($_POST['idChat']);

        echo json_encode($chat);
    }
}