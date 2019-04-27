<?php
session_start();
ob_start();

use app\core\Router;
use app\core\URL_MANAGER;
use app\config\Params;
use app\core\Helpers;
use app\core\User;

define("SITE", "site");
define("PATH", __DIR__ . '/media');

set_include_path("app/controllers" . PATH_SEPARATOR . "app/models" . PATH_SEPARATOR . "app/core" . PATH_SEPARATOR . "app/config");
spl_autoload_register();

require_once 'vendor/autoload.php';

new Params();

if (isset($_GET['controller'])) {
    $router = new Router($_GET['controller']);
    $router->goHome('main');
}
?>
<!--<button class="btn btn-success myBtn">Ajax</button>-->

