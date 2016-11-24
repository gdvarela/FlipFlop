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
if($view->hasFlash()) {
    echo "<div class=\"pops\"><span class=\"pop-text\">".$view->popFlash()."</span></div>";
}
?>
<a href="index.php" class="logo"></a>
<a href="index.php" class="title text">Flip - Flop</a>
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
        <div class="chat-tab" data-id="1">
            <span class="text chat-tab-text">Chat 1</span>
        </div>
    </div>
</div>

<div class="chat-modal" hidden="true">
    <div class="chat-modal-content">
        <div class="chat-modal-tittle text">
            <span class="chat-modal-tittle-name"></span>
            <i id="close-chat" class="close-icon fa fa-times fa-fw" aria-hidden="true"></i>
        </div>
        <div class="msg-content">
        </div>
    </div>
    <div class="chat-modal-input">
        <form>
            <input class="chat-input" type="text" name="chatInput" placeholder="Enter your message">
        </form>
    </div>
</div>
</body>
</html>