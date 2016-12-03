<?php
 //file: view/layouts/default.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");
 
?>

<div class="content">
	<div class="back-title">
        <a href="?controller=index&action=welcome"><?= i18n("Back")?></a>
    </div>
</div>