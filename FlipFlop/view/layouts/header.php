<?php

require_once(__DIR__."/../../core/ViewManager.php");
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
    <div class="logo">
    </div>
    <div class="title text"> Flip - Flip
    </div>
    <div class="login">
        <!--<div class="l_title"> Login</div>-->
        <form action="?controller=users&action=login" method="POST">
            <div class="login-input">
                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                <input class="input" type="text" name="login" placeholder="Nick">
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