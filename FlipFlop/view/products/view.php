<?php
//file: view/products/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$product = $view->getVariable("products");
$errors = $view->getVariable("errors");
$view->setVariable("product", "View Product");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <title>Title</title>
    </head>

    <body>
        <div class="content">
            <a class="button light-border" href="../FlipFlop/index.php">
                <i class="fa fa-list fa-fw fa-3x" aria-hidden="true"></i>
                <span class="text button-text2"><?= i18n("Back") ?></span>
            </a>
            <div class="img-list">
                <div>
                    <img class="d-img light-border" src="../img/chancleta2.jpg">
                </div>
                <div class="sub-img-box">
                    <img class="sub-img light-border" src="../img/chancleta2.jpg">
                    <img class="sub-img light-border" src="../img/chancleta2.jpg">
                </div>
            </div>
            <div class="des-head light-border">
                <div class="p-row rowtext">
                    <div class="p-title text"><?= i18n("Product").": ".htmlentities( $product->getProductName() ) ?></div>
                    <div class="p-price text"><?= i18n("Price").": ".htmlentities( $product->getPrice() ) ?></div>
                </div>
                <div>
                    <div class="p-row rowtext"><?= i18n("Description").": ".htmlentities( $product->getDescription() ) ?></div>
                    <div class="p-row rowtext"><?= i18n("Tags").": ".htmlentities( $product->getTags() ) ?></div>
                        <div>
                            <div class="p-row2 rowtext"><?= i18n("Seller").": ".htmlentities( $product->getSeller() ) ?></div>
                            <div class="p-row2 rowtext"><?= i18n("Added").": ".htmlentities( $product->getAddDate() ) ?></div>
                        </div>
                </div>
        </div>
    </body>

</html>
