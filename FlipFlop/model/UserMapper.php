<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
 * Class UserMapper
 * Database interface for User entities
 */
class UserMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Saves a User into the database
   * 
   * @param User $user The user to be saved
   * @throws PDOException if a database error occurs
   * @return void
   */      
  public function save($user) {
    $stmt = $this->db->prepare("INSERT INTO Users values (?,?,?,?,?,?,?,?)");
    $stmt->execute(array($user->getId(), $user->getLogin(), $user->getPass(), $user->getName(), $user->getLastname(), $user->getEmail(), $user->getPhone(), $user->getDNI()));
  }
  
  /**
   * Checks if a given username is already in the database
   * 
   * @param string $login the username to check
   * @return boolean true if the username exists, false otherwise
   */
  public function loginExists($login) {
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
  public function dniExists($DNI) {
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
  public function isValidUser($login, $pass) {
    $stmt = $this->db->prepare("SELECT count(login) FROM users where login=? and pass=?");
    $stmt->execute(array($login, $pass));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }
}