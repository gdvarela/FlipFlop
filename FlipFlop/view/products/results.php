<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$results = $view->getVariable("results");
?>
<div class="content">
    <div class="chat-buttom ">
    </div>
    <div class="list">
        <?php foreach($results as $product): ?>
            <div class="product">
                <a href="?controller=products&action=view&id=<?= $product->getId() ?>">
                    <img class="p-img light-border" src="img/chancleta2.jpg"> </a>
                <div class="p-title text"><?= $product->getProductName() ?></div>
                <div class="p-price text light-border"><?= $product->getPrice() ?>&euro;</div>
                <div class="p-text text">
                    <span><?= $product->getDescription() ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
