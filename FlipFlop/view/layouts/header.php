<?php

require_once(__DIR__."/../../core/ViewManager.php");
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
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <?php
    if($view->hasFlash()) {
        echo "<div class=\"pops\"><span class=\"pop-text\">".$view->popFlash()."</span></div>";
    }
    ?>
    <div class="logo">
    </div>
    <div class="title text"> Flip - Flip
    </div>
    <div class="login">
        <form action="?controller=users&action=login" method="POST">
            <div class="login-input">
                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                <input class="input" type="text" name="login" <?php if(isset($_SESSION["ERRORS"]["login"]))
                        { echo "value=".$_SESSION["ERRORS"]["login"]."";} ?> placeholder="Nick">
            </div>
            <div class="login-input">
                <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                <input class="input" type="password" name="pass" placeholder="Password">
            </div>
            <button class="l_button" type="submit">Entrar</button>
            <a href="?controller=users&action=register"><button class="l_button" type="button">Registrarse</button></a>
        </form>
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