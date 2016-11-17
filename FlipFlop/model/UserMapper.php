<?php
// file: model/UserMapper.php

require_once(__DIR__ . "/../core/PDOConnection.php");

/**
 * Class UserMapper
 * Database interface for User entities
 */
class UserMapper
{

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function save($user)
    {
        $stmt = $this->db->prepare("INSERT INTO Users values (?,?,?,?,?,?,?,?)");
        $stmt->execute(array($user->getId(), $user->getLogin(), $user->getPass(), $user->getName(), $user->getLastname(),
            $user->getEmail(), $user->getPhone(), $user->getDNI()));
    }

    public function modify($user)
    {
        $stmt = $this->db->prepare("INSERT INTO Users WHERE login= $user->getLogin() values (?,?,?,?,?,?)");
        $stmt->execute(array($user->getPass(), $user->getName(), $user->getLastname(), $user->getEmail(), $user->getPhone(), $user->getDNI()));
    }

    public function view($user)
    {
        $stmt = $this->db->query("SELECT * FROM Users WHERE login= $user->getLogin()");
    }

    public function delete($user)
    {
        $stmt = $this->db->query("DELETE * FROM Users WHERE login= $user->getLogin()");
    }

    public function loginExists($login)
    {
        $stmt = $this->db->prepare("SELECT count(login) FROM users where login=?");
        $stmt->execute(array($login));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * Checks if a given dni is already in the database
     *
     * @param string $DNI the DNI to check
     * @return boolean true if the DNI exists, false otherwise
     */
    public function dniExists($DNI)
    {
        $stmt = $this->db->prepare("SELECT count(DNI) FROM users where DNI=?");
        $stmt->execute(array($DNI));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * Checks if a given pair of username/password exists in the database
     *
     * @param string $login the username
     * @param string $pass the password
     * @return boolean true the username/passwrod exists, false otherwise.
     */
    public function isValidUser($login, $pass)
    {
        $stmt = $this->db->prepare("SELECT * FROM Users where login=? and pass=?");
        $stmt->execute(array($login, $pass));
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user;
    }

}