<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Product.php");
require_once(__DIR__."/../model/ProductMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

class ProductsController extends BaseController {

    private $productMapper;

    public function __construct() {
        parent::__construct();

        $this->productMapper = new ProductMapper();

        $this->view->setLayout("header");
    }

    public function last() {

        $products = $this->productMapper->listLast();
        $this->view->setVariable("products", $products);

        $this->view->render("products", "index");
    }
}