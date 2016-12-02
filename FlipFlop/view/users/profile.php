<?php
//file: view/users/profile.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
?>
<div class="profile-content">
    <span class="profile-name"><?=$user->getName()?> <?=$user->getLastname()?></span>
    <span class="profile-login"><?=$user->getLogin()?></span>
</div>

<a href="?controller=products&action=add">Añadir producto</a>
<br>
<a>Mis productos</a>
<br>
<a>Modificar datos</a>



