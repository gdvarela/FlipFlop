<?php
//file: view/products/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$product = $view->getVariable("product");
$errors = $view->getVariable("errors");

$view->setVariable("title", "Edit Product");

?>
<div class="content">

    <div>
        <h1><?= i18n("Modify product") ?></h1>

        <form action="?controller=products&action=edit&id=<?= $product->getId() ?>" enctype="multipart/form-data" method="POST">
            <?= i18n("Product") ?>: <br>
            <input type="text" name="name" class="add-input" disabled="disabled"
                   value="<?= isset($_POST["product"])?$_POST["product"]:$product->getProductName() ?>">
            <?= isset($errors["product"])?$errors["product"]:"" ?><br>

            <?= i18n("Description") ?>: <br>
            <textarea name="description" class="add-desc"
                      value="<?= isset($_POST["description"])?$_POST["description"]:$product->getDescription() ?>"></textarea>
            <?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <?= i18n("Price") ?>: <br>
            <input type="text" name="price" class="add-input"
                   value="<?= isset($_POST["price"])?$_POST["price"]:$product->getPrice() ?>"></textarea>>
            <?= isset($errors["price"])?$errors["price"]:"" ?><br>

            <?= i18n("Tags") ?>: <br>
            <input type="text" name="tags" class="add-input"
                   value="<?= isset($_POST["tags"])?$_POST["tags"]:$product->getTags() ?>">
            <?= isset($errors["tags"])?$errors["tags"]:"" ?><br>

            <input class="add-button" type="submit" name="submit" value=<?= i18n("Create")?>>
        </form>
    </div>
</div>