<?php
//file: view/products/add.php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../core/I18n.php");
$view = ViewManager::getInstance();
$product = $view->getVariable("product");
$errors = $view->getVariable("errors");
$view->setVariable("title", "Add Product");
?>

<div class="content">

    <h1><?= i18n("Create product")?></h1>
    <form action="?controller=products&amp;action=add" enctype="multipart/form-data" method="POST">
        <?= i18n("Product") ?>: <input type="text" name="name">
        <?= isset($errors["product"])?$errors["product"]:"" ?><br>

        <?= i18n("Description") ?>: <br>
        <textarea name="description" rows="4" cols="50"></textarea>
        <?= isset($errors["description"])?$errors["description"]:"" ?><br>

        <?= i18n("Price") ?>: <input type="text" name="price">
        <?= isset($errors["price"])?$errors["price"]:"" ?><br>

        <?= i18n("Tags") ?>: <input type="text" name="tags">
        <?= isset($errors["tags"])?$errors["tags"]:"" ?><br>

        <?= i18n("Picture") ?>: <input type="file" id="file" name="file" multiple="multiple" accept="image/*" />
        <?= isset($errors["picture"])?$errors["picture"]:"" ?><br>

        <input type="submit" name="submit" value=<?= i18n("Send")?>>
    </form>
</div>