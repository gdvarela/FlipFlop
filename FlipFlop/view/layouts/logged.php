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
    <div class="login">Logged</div>
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