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
    <div class="title text"> Flip - Flop
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
            <button id="register-button" class="l_button" type="button">Registrarse</button>
        </form>
    </div>
    <div id="register-modal" class="register-modal">
        <div class="register-content">
            <form action="?controller=users&action=register" method="POST">
                <div class="register">
                    <span class="text">Nickname: </span>
                    <div class="register-input">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                        <input class="input" type="text" name="login" placeholder="Nick" autofocus>
                    </div>
                </div>
                <div class="register">
                    <span class="text">Password: </span>
                    <div class="register-input">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                        <input class="input" type="password" name="pass" placeholder="Password" autofocus>
                    </div>
                </div>
                <div class="register">
                    <span class="text">Repeat Password: </span>
                    <div class="register-input">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                        <input class="input" type="password" name="pass2" placeholder="Password" autofocus>
                    </div>
                </div>
                <div class="register">
                    <span class="text">Name: </span>
                    <div class="register-input">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                        <input class="input" type="text" name="name" placeholder="Name" autofocus>
                    </div>
                </div>
                <div class="register">
                    <span class="text">Last name: </span>
                    <div class="register-input">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                        <input class="input" type="text" name="lastname" placeholder="Last name" autofocus>
                    </div>
                </div>
                <div class="register">
                    <span class="text">Email: </span>
                    <div class="register-input">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                        <input class="input" type="email" name="email" placeholder="Email" autofocus>
                    </div>
                </div>
                <div class="register">
                    <span class="text">Phone: </span>
                    <div class="register-input">
                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                        <input class="input" type="number" name="phone" placeholder="Phone" autofocus>
                    </div>
                </div>
                <button class="l_button" type="submit">Register</button>
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