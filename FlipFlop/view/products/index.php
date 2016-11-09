<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$products = $view->getVariable("products");
?>

<div class="content">
    <div class="search">
        <form action="">
            <input id="search-box" class="text light-border" placeholder="Search" type="search">
        </form>
    </div>
    <div class="chat-buttom ">
    </div>
    <div class="list">
        <?php foreach($products as $product): ?>
            <div class="product">
                <a href="?controller=products&action=view&id="<?= $product["id"] ?>> <img class="p-img light-border" src="img/chancleta2.jpg"> </a>
                <div class="p-title text"><?= $product["product_name"] ?></div>
                <div class="p-price text light-border"><?= $product["price"] ?>&euro;</div>
                <div class="p-text text">
                    <span><?= $product["description"] ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
