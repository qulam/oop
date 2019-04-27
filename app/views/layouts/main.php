<?php

use app\core\Layouts;
use app\core\Session;
use app\core\Helpers;
use app\core\User;

?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(Helpers::isAjax() === false): ?>
        <?php AssetsCore::registerAssets('defaultAssets'); ?>
    <?php endif; ?>

</head>
<body>
<div id="main">
    <?php if (User::isGuest()): ?>
        <div class="main-content">
            <?php Layouts::LoginRequired(); ?>
        </div>
    <?php else: ?>

        <?php Layouts::Head('header'); ?>

        <div class="main-content">
            <?php
                if(isset($_GET['controller'])){
                    $url = $_GET['controller'];
                }else{
                    $url = SITE;
                }
            ?>
            <?php Layouts::Main($url); ?>
        </div>

        <div class="site-footer">
            <?php Layouts::Foot('footer'); ?>
        </div>

    <?php endif; ?>
</div>
</body>
</html>