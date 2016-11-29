<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Chat.php");
require_once(__DIR__."/../model/Message.php");


class ChatMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function getMessages($chatId, $lastTime)
    {
        if($lastTime=="new") {
            $stmt = $this->db->prepare("SELECT * FROM Messages WHERE idChat=? order by time asc");
            $stmt->execute(array($chatId));
        } else {
            $stmt = $this->db->prepare("SELECT * FROM Messages WHERE idChat=? and time > ? order by time asc");
            $stmt->execute(array($chatId, $lastTime));
        }
        $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chat;
    }

    public function getChatInfo($chatId)
    {
        $stmt = $this->db->prepare("select product_name, Users.name from Chats, Products, Users where Chats.idProduct = Products.id and Chats.idInterested = Users.id and Chats.idChat = ?");
        $stmt->execute(array($chatId));
        $chatInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chatInfo;
    }

    public function saveMsg($msg)
    {
        $stmt = $this->db->prepare("INSERT INTO Messages (message, idChat, owner, time) values(?,?,?,?)");
        $stmt->execute(array($msg->getText(), $msg->getIdChat(), $msg->getOwner(), $msg->getTime()));
    }

    public function getUserChats($usr)
    {
        $stmt = $this->db->prepare("SELECT idChat, product_name FROM Chats, Products WHERE Products.id = Chats.idProduct and (idInterested = ? or seller = ?);");
        $stmt->execute(array($usr, $usr));
        $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chats;
    }
}