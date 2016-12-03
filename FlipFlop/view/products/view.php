<?php
//file: view/products/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$product = $view->getVariable("product");
$uri = $view->getVariable("uri");
$errors = $view->getVariable("errors");
$view->setVariable("title", "View Product");

?>
<div class="content">

    <div class="des-head light-border">
        <div class="p-row rowtext">
            <div class="p-title text"><?= i18n("Product").": ".htmlentities($product->getProductName() ) ?></div>
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
        <button class="add-button2 rowtext" type="button" action="?controller=base&amp;action=createChat($product->getId())">
            <?= i18n("Contact seller") ?></button>
    </div>


    <?php foreach($uri[0] as $u): ?>
        <img class="d-img light-border" src="../FlipFlop/resources/<?= $u ?>.jpg">
    <?php endforeach; ?>

</div>
