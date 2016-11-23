<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <title>Title</title>
</head>
<body>
<script src="js/jquery-3.1.1.min.js"></script>
<?php
if($view->hasFlash()) {
    echo "<div class=\"pops\"><span class=\"pop-text\">".$view->popFlash()."</span></div>";
}
?>
<a href="index.php" class="logo"></a>
<a href="index.php" class="title text">Flip - Flip</a>
<div class="login">
    <div class="logged text">
        <div class="profile">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="profile-name"><?= $_SESSION["currentusername"] ?></span>
        </div>
        <form class="profile-form" action="?controller=users&action=logout" method="POST">
            <button class="l_button" type="submit">Logout</button>
        </form>
        <form class="profile-form" action="?controller=users&action=profile" method="POST">
            <button class="l_button" type="submit">My Profile</button>
        </form>
    </div>
</div>
<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
<div class="footer">
    <div class="foot">
        <div class="up-button">
            <a href="#search-box">
                <i class="fa fa-arrow-circle-up fa-2x" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>
</body>

</html>