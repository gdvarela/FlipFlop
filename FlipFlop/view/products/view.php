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
            <div class="p-price rowtext"><?= i18n("Price").": ".htmlentities( $product->getPrice() ) ?></div>
        </div>
        <div>
            <div class="p-row rowtext"><?= i18n("Description").": ".htmlentities( $product->getDescription() ) ?></div>
            <div class="p-row rowtext"><?= i18n("Tags").": ".htmlentities( $product->getTags() ) ?></div>
                <div>
                    <div class="p-row2 rowtext"><?= i18n("Seller").": ".htmlentities( $product->getSeller() ) ?></div>
                    <div class="p-row2 rowtext"><?= i18n("Added").": ".htmlentities( $product->getAddDate() ) ?></div>
                </div>
        </div>
        <form action="?controller=base&amp;action=createChat" method="POST" enctype="multipart/form-data">
            <input hidden value="<?= $product->getSeller() ?>" name="owner">
            <?php if(isset($_SESSION["currentusername"])){ echo "<button class='add-button2 rowtext' value=".$product->getId()." name='pid'>".i18n("Contact seller")."</button>";}?>
        </form>
    </div>

    <?php foreach($uri[0] as $u): ?>
        <img class="d-img light-border" src="../FlipFlop/resources/<?= $u ?>.jpg">
    <?php endforeach; ?>

</div>
