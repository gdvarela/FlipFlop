<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../controller/BaseController.php");

class ProductsController extends BaseController {

    private $productMapper;

    public function __construct() {
        parent::__construct();

        $this->productMapper = new ProductMapper();

        $this->view->setLayout("welcome");
    }

}