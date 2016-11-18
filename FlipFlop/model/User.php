<?php
// file: model/User.php

require_once(__DIR__ . "/../core/ValidationException.php");

/**
 * Class User
 * Represents a User in the blog
 */
class User
{


    private $id;
    private $login;
    private $pass;
    private $name;
    private $lastname;
    private $email;
    private $phone;
    private $DNI;

    /**
     * The constructor
     * @param null $id
     * @param null $login
     * @param null $pass
     * @param null $name
     * @param null $lastname
     * @param null $email
     * @param null $phone
     * @param null $DNI
     * @internal param string $var The name of the var
     */
    public function __construct($id = NULL, $login = NULL, $pass = NULL, $name = NULL, $lastname = NULL, $email = NULL, $phone = NULL, $DNI = NULL)
    {
        $this->id = $id;
        $this->pass = $pass;
        $this->login = $login;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->DNI = $DNI;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param null $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return null
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param null $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param null $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param null $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return null
     */
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * @param null $DNI
     */
    public function setDNI($DNI)
    {
        $this->DNI = $DNI;
    }

    public function checkIsValidForRegister($pass2)
    {

        $errors = array();
        if (strlen($this->login) < 5) {
            $errors["username"] = "Username must be at least 5 characters length";
        }
        if (strlen($this->pass) < 5) {
            $errors["password"] = "Password must be at least 5 characters length";
        }
        if (strlen($this->name) < 3) {
            $errors["name"] = "Your name must be at least 5 characters length";
        }
        if (strlen($this->lastname) < 10) {
            $errors["lastname"] = "Lastname must be at least 5 characters length";
        }
        if (strlen($this->email) < 5 && (substr_count($this->email, "@") == 1)) {
            $errors["email"] = "Email must be at least 5 characters length";
        }
        if (strlen($this->phone) > 12) {
            $errors["phone"] = "phone number must be 12 characters length";
        }
        if (strlen($this->DNI) != 9) {
            $errors["DNI"] = "DNI must be 9 characters length";
        }
        if ($this->pass != $pass2) {
            $errors["password2"] = "Passwords must be identical";
        }


        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "user is not valid");
        }
    }
}