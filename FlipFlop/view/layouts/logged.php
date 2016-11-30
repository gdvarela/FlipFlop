<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <title>Title</title>
</head>
<body>
<script src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<?php
if ($view->hasFlash()) {
    echo "<div class=\"pops\"><span class=\"pop-text\">" . $view->popFlash() . "</span></div>";
}
?>
<data id="currentuser" value="<?= $_SESSION["currentuser"] ?>"></data>
<a href="index.php" class="logo"></a>
<a href="index.php" class="title text">Flip - Flop</a>
<div class="login">
    <div class="logged text">
        <div class="profile">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="profile-name"><?= $_SESSION["currentusername"] ?></span>
        </div>
        <form class="profile-form" action="?controller=users&action=logout" method="POST">
            <button class="l_button" type="submit"><?= i18n("Logout")?></button>
        </form>
        <form class="profile-form" action="?controller=users&action=profile" method="POST">
            <button class="l_button" type="submit"><?= i18n("My Profile")?></button>
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
        <?php foreach($_SESSION["currentuserchats"] as $chat): ?>
        <div class="chat-tab" id="chat-tab-<?= $chat["idChat"]?>" data-id="<?= $chat["idChat"]?>">
            <span class="text chat-tab-text"><?= $chat["product_name"]?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="chat-modal" hidden="true">
    <div class="chat-modal-content">
        <div class="chat-modal-tittle text">
            <span class="chat-modal-tittle-name"></span>
            <i id="close-chat" class="close-icon fa fa-times fa-fw" aria-hidden="true"></i>
        </div>
        <div class="chat-modal-msg-content">
        </div>
    </div>
    <div class="chat-modal-input">
        <input class="chat-input" type="text" placeholder="Enter your message">
    </div>
</div>
</body>
</html>