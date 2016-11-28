<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Message
{
    private $text;
    private $idChat;
    private $owner;
    private $time;

    public function __construct($text, $idChat, $owner, $time)
    {
        $this->text = $text;
        $this->idChat = $idChat;
        $this->owner = $owner;
        $this->time = $time;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getIdChat()
    {
        return $this->idChat;
    }

    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;
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