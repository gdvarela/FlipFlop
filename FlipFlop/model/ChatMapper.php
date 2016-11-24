<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Chat.php");

class ChatMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function getMessages($chatId, $lastTime)
    {
        if($lastTime=="new") {
            $stmt = $this->db->prepare("SELECT * FROM Messages WHERE idChat=? order by time desc");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM Messages WHERE idChat=1 and Messages.time > $lastTime order by time desc");
        }

        $stmt->execute(array($chatId));
        $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chat;
    }

    public function getChatInfo($chatId)
    {
        $stmt = $this->db->prepare("select product_name, Users.name from Chats, Products, Users where Chats.idProduct = Products.id and Chats.idInterested = Users.id and Chats.idChats = ?");
        $stmt->execute(array($chatId));
        $chatInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chatInfo;
    }
}