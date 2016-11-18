<?php
//file: view/products/add.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$product = $view->getVariable("product");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Product");

?><h1><?= i18n("Create product")?></h1>
<form action="index.php?controller=products&amp;action=add" method="POST">
    <?= i18n("Product") ?>: <input type="text" name="name"
                                 value="<?= $product->getTitle() ?>">
    <?= isset($errors["product"])?$errors["product"]:"" ?><br>

    <?= i18n("Description") ?>: <br>
    <textarea name="description" rows="4" cols="50"><?=
        $product->getDescription() ?></textarea>
    <?= isset($errors["description"])?$errors["description"]:"" ?><br>

    <?= i18n("Price") ?>: <input type="text" name="price"
                                        value="<?= $product->getPrice() ?>">
    <?= isset($errors["price"])?$errors["price"]:"" ?><br>

    <?= i18n("Tags") ?>: <input type="text" name="tags"
                                        value="<?= $product->getTags() ?>">
    <?= isset($errors["tags"])?$errors["tags"]:"" ?><br>

    <input type="submit" name="submit" value="submit">
</form>