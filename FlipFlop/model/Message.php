<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Message
{
    public $idChat;
    public $idMessage;

    public $text;
    public $owner;
    public $time;

    public function __construct($idChat, $idMessage, $text, $owner, $time)
    {
        $this->idChat = $idChat;
        $this->idMessage = $idMessage;
        $this->text = $text;
        $this->owner = $owner;
        $this->time = $time;
    }

    public function getIdChat()
    {
        return $this->idChat;
    }

    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;
    }

    public function getIdMessage()
    {
        return $this->idMessage;
    }

    public function setIdMessage($idMessage)
    {
        $this->idMessage = $idMessage;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }
}