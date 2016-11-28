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

    <div>
        <h1 class=""><?= i18n("Create Product")?></h1>
        <form action="?controller=products&amp;action=add" enctype="multipart/form-data" method="POST">
            <?= i18n("Product") ?>: <br>
            <input type="text" name="name" class="add-input">
            <?= isset($errors["product"])?$errors["product"]:"" ?><br>

            <?= i18n("Description") ?>: <br>
            <textarea name="description" class="add-desc"></textarea>
            <?= isset($errors["description"])?$errors["description"]:"" ?><br>

            <?= i18n("Price") ?>: <br>
            <input type="text" name="price" class="add-input">
            <?= isset($errors["price"])?$errors["price"]:"" ?><br>

            <?= i18n("Tags") ?>: <br>
            <input type="text" name="tags" class="add-input">
            <?= isset($errors["tags"])?$errors["tags"]:"" ?><br>

            <?= i18n("Picture(s)") ?>: <br>
            <input class="add-input" type="file" name="files" multiple="multiple" accept="image/*">
            <?= isset($errors["picture"])?$errors["picture"]:"" ?><br>

            <input class="add-button" type="submit" name="submit" value=<?= i18n("Create")?>>
        </form>
    </div>
</div>