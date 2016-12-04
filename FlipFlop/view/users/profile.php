<?php
//file: view/users/profile.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", "Profile");
$products = $view->getVariable("products");


?>


<div class="content">
    <div class="des-head">
        <div><?= i18n("Hello") ." ". $user->getLogin()?></div>
        <a href="?controller=products&action=add">Añadir producto</a><br>
    </div>

    <div>Mis productos</div>

    <div class="list">
        <?php foreach($products as $product): ?>
            <div class="product">
                <a href="?controller=products&action=listFromUser&id=<?= $_SESSION["currentuser"] ?>">
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



