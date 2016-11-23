<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Chat.php");

class ChatMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function getMessages($chatId)
    {
        $stmt = $this->db->prepare("SELECT * FROM Messages WHERE idChat=?");
        $stmt->execute(array($chatId));
        $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $chat;
    }
}