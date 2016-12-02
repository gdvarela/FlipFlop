<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Chat.php");
require_once(__DIR__."/../model/Message.php");


class ChatMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function getMessages($chatId, $last)
    {
        if($last == 0) {
            $stmt = $this->db->prepare("SELECT * FROM Messages WHERE idChat=? order by idMessage asc");
            $stmt->execute(array($chatId));
            $list_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM Messages WHERE idChat=? and idMessage > ? order by idMessage asc");
            $stmt->execute(array($chatId, $last));
            $list_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $messages = array();

        foreach ($list_bd as $message) {
            array_push($messages, new Message($message["idChat"], $message["idMessage"], $message["message"], $message["owner"], $message["time"]));
        }

        return $messages;
    }

    public function getChatInfo($chatId)
    {
        $stmt = $this->db->prepare("select product_name, Users.name, Chats.lastMessage from Chats, Products, Users where Chats.idProduct = Products.id and Products.seller = Users.id and Chats.idChat = ?");
        $stmt->execute(array($chatId));
        $chatInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chatInfo;
    }

    public function saveMsg($msg)
    {
        $stmt = $this->db->prepare("INSERT INTO Messages (message, idChat, owner, time) values(?,?,?,?)");
        $stmt->execute(array($msg->getText(), $msg->getIdChat(), $msg->getOwner(), $msg->getTime()));

        $stmt = $this->db->prepare("UPDATE Chats SET lastMessage = (select MAX(idMessage) from messages where idChat = ?) WHERE idChat = ?");
        $stmt->execute(array($msg->getIdChat(), $msg->getIdChat()));
    }

    public function getUserChats($usr)
    {
        $stmt = $this->db->prepare("SELECT idChat, product_name FROM Chats, Products WHERE Products.id = Chats.idProduct and (idInterested = ? or seller = ?);");
        $stmt->execute(array($usr, $usr));
        $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chats;
    }

    public function create($usr, $pid)
    {
        $stmt = $this->db->prepare("INSERT INTO Chats (idProduct, idInterested) values (?,?)");
        $stmt->execute(array($pid, $usr));
    }
}