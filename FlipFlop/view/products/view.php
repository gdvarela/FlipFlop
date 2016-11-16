<?php
//file: view/products/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$product = $view->getVariable("product");
$currentuser = $view->getVariable("currentusername");
$errors = $view->getVariable("errors");

$view->setVariable("title", "View Product");

?>

<a href="html/description.html"> <img class="p-img light-border" src="img/chancleta2.jpg"> </a>
<div class="p-title text"><?= sprintf(i18n("by %s"),$post->getAuthor()->getUsername()) ?></div>
<div class="p-price text light-border">4,99 €</div>
<div class="p-text text">
    <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>
</div>
