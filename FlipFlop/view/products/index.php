<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$products = $view->getVariable("products");
?>
<div class="content">
    <div class="search">
        <form action="?controller=products&amp;action=search" method="POST">
            <input id="search-box" name="searchbox" class="texts light-border"  type="search" placeholder="<?= i18n("Search") ?>">
        </form>
    </div>
    <div class="chat-buttom ">
    </div>
    <div class="list">
        <?php foreach($products as $product): ?>
            <div class="product">
                <a href="?controller=products&action=view&id=<?= $product->getId() ?>">
                    <img class="p-img light-border" src="img/<?= $product->getImg() ?>"> </a>
                <div class="p-title text"><?= $product->getProductName() ?></div>
                <div class="p-price text light-border"><?= $product->getPrice() ?>&euro;</div>
                <div class="p-text text">
                    <span><?= $product->getDescription() ?></span>
                </div>
    </div>
        <?php endforeach; ?>
    </div>
</div>
