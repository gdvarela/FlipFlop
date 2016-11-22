<?php
//file: view/users/profile.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$date = $view->getVariable("date");
$view->setVariable("title", "Profile");
$view->setVariable("date", $date);
?>

<a><?= htmlentities( $date ) ?></a>
<a href="../products/add.php">Añadir producto</a>
<br>
<a>Mis productos</a>
<br>
<a>Modificar datos</a>


