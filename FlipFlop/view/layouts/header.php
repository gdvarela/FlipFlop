<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
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
if ($view->hasFlash()) {
    echo "<div class=\"pops\"><span class=\"pop-text\">" . $view->popFlash() . "</span></div>";
}
?>
<data id="register-data" value="<?= $errors["register"] ?>"></data>
<?php $errors["register"] = NULL; ?>
<a href="index.php" class="logo"></a>
<a href="index.php" class="title text">Flip - Flip</a>
<div class="login">
    <form action="?controller=index&action=welcome" method="POST">
        <div class="login-input">
            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
            <input class="input" type="text" name="userLogin" value="<?php if (isset($errors["userLogin"])) {
                echo $errors["userLogin"];
            } ?>" placeholder="Nick">
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
        <form action="?controller=index&action=welcome" method="POST">
            <div class="register">
                <span class="text">Nickname: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="text" name="login" placeholder="Nick" value="<?= $user->getLogin() ?>">
                </div>
                <span class="register-error"><?php if (isset($errors["username"])) {
                        echo $errors["username"];
                    } ?></span>
            </div>
            <div class="register">
                <span class="text">Password: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="password" name="password" placeholder="Password">
                </div>
                <span class="register-error"><?php if (isset($errors["password"])) {
                        echo $errors["password"];
                    } ?></span>
            </div>
            <div class="register">
                <span class="text">Repeat Password: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="password" name="password2" placeholder="Password">
                </div>
                <span class="register-error"><?php if (isset($errors["password2"])) {
                        echo $errors["password2"];
                    } ?></span>
            </div>
            <div class="register">
                <span class="text">Name: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="text" name="name" placeholder="Name" value="<?= $user->getName() ?>">
                </div>
                <span class="register-error"><?php if (isset($errors["name"])) {
                        echo $errors["name"];
                    } ?></span>
            </div>
            <div class="register">
                <span class="text">Last name: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="text" name="lastname" placeholder="Last name"
                           value="<?= $user->getLastname() ?>">
                </div>
                <span class="register-error"><?php if (isset($errors["lastname"])) {
                        echo $errors["lastname"];
                    } ?></span>
            </div>
            <div class="register">
                <span class="text">DNI: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="text" name="dni" placeholder="DNI" value="<?= $user->getDNI() ?>">
                </div>
                <span class="register-error"><?php if (isset($errors["DNI"])) {
                        echo $errors["DNI"];
                    } ?></span>
            </div>
            <div class="register">
                <span class="text">Email: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="email" name="email" placeholder="Email" value="<?= $user->getEmail() ?>">
                </div>
                <span class="register-error"><?php if (isset($errors["email"])) {
                        echo $errors["email"];
                    } ?></span>
            </div>
            <div class="register">
                <span class="text">Phone: </span>
                <div class="register-input">
                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                    <input class="input" type="text" name="phone" placeholder="Phone" value="<?= $user->getPhone() ?>">
                </div>
                <span class="register-error"><?php if (isset($errors["phone"])) {
                        echo $errors["phone"];
                    } ?></span>
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
        <div class="chat-tab">
            <span class="text chat-tab-text">Chat 1</span>
        </div>
    </div>
</div>

<div class="chat-modal">
    <div class="chat-modal-content">
        <div class="chat-modal-tittle text">Alpargata: Juan</div>
        <div class="chat-self">
            <span>Yo:</span>
            <span>Hola</span>
        </div>
        <div class="chat-their">
            <span>Hola</span>
        </div>

    </div>
    <div class="chat-modal-input">
        <form>
            <input class="chat-input" type="text" name="pass" placeholder="Enter your message">
        </form>
    </div>
</div>

</body>

</html>