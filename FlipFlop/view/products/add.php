<?php
//file: view/products/add.php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../core/I18n.php");
$view = ViewManager::getInstance();
$product = $view->getVariable("product");
$errors = $view->getVariable("errors");
$view->setVariable("title", "Edit Product");

?>

<div class="content">
    <div class="search">
        <form action="">
            <input id="search-box" class="text light-border" placeholder="Search" type="search">
        </form>
    </div>
    <div class="chat-buttom ">
    </div>

    <h1><?= i18n("Create product")?></h1>
    <form action="?controller=products&amp;action=add" method="POST">
        <?= i18n("Product") ?>: <input type="text" name="name">
        <?= isset($errors["product"])?$errors["product"]:"" ?><br>

        <?= i18n("Description") ?>: <br>
        <textarea name="description" rows="4" cols="50"></textarea>
        <?= isset($errors["description"])?$errors["description"]:"" ?><br>

        <?= i18n("Price") ?>: <input type="text" name="price">
        <?= isset($errors["price"])?$errors["price"]:"" ?><br>

        <?= i18n("Tags") ?>: <input type="text" name="tags">
        <?= isset($errors["tags"])?$errors["tags"]:"" ?><br>

        <input type="submit" name="submit" value=<?= i18n("Send")?>>
    </form>
</div>