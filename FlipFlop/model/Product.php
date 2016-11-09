<?php
//file: model/Product.php

require_once(__DIR__."/../core/ValidationException.php");

class Product {

    private $id;
    private $product_name;
    private $description;
    private $price;
    private $tags;


    //constructor

    /**
     * Product constructor.
     * @param null $id
     * @param null $product_name
     * @param null $description
     * @param null $price
     * @param null $tags
     */
    public function __construct($id = NULL, $product_name = NULL, $description = NULL, $price = NULL, $tags = NULL) {
        $this->id = $id;
        $this->product_name = $product_name;
        $this->description = $description;
        $this->price = $price;
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * @param mixed $product_name
     */
    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function checkIsValidForRegister()
    {
        $errors = array();
        if (strlen($this->product_name) < 3) {
            $errors["product"] = "Product must be at least 5 characters length";
        }
        if (strlen($this->description) < 10) {
            $errors["product"] = "Product description must be at least 10 characters length";
        }
        if ( $this->price == 0 ) {
            $errors["product"] = "Price can't be 0";
        }
        if (strlen($this->tags) < 1) {
            $errors["product"] = "Product tags must be at least 10 characters length";
        }
        if (sizeof($errors)>0){
            throw new ValidationException($errors, "product is not valid");
        }
    }

}