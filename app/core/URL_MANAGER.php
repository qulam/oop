<?php

namespace app\core;

use app\config\Params;
use app\core\Helpers;
use app\core\User;

class URL_MANAGER extends Controller
{
    protected static $url;

    public function __construct($url = false)
    {
        self::$url = $url;
    }

    public static function actionMethod($url)
    {
        $prettyUrl = Params::ParamsConfig();
        foreach ($prettyUrl['rules'] as $key => $value) {
            if ($key == $url) {
                $url = $value;
            }
        }

        if (isset($_GET['controller']) && !empty($_GET['controller'])) {
            $controller = $_GET['controller'];
            if (!file_exists('app/controllers/' . $controller . 'Controller.php')) {
                require_once './app/views/layouts/error.php';
                return false;
            }
        }

        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $action = $_GET['action'];
        }

        $className = $controller . "Controller";
        if(isset($action)){
            $methodName = "action" . $action;
        }else{
            $methodName = 'actionIndex';
        }

        if (User::isGuest()) {
            $className = 'siteController';
            $methodName = 'actionLogin';
        }

        self::actionControllerMethod($className, $methodName);
    }


    public static function actionControllerMethod($controller, $action)
    {
        if (file_exists('./app/controllers/' . $controller . '.php')) {
            $className = str_replace("/", "\\", "/" . __NAMESPACE__ . "/" . $controller);
            $newClassName = str_replace("core", "controllers", $className);

            $object = new $newClassName();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST["data"]) && Helpers::isAjax()) {
                    return $object->$action($_POST["data"]);
                } else {
                    if (!empty(Helpers::getId())) {
                        return $object->$action(Helpers::getId());
                    } else {
                           return $object->$action();
                    }
                }
            }
            if (Helpers::getId()) {
                return $object->$action(Helpers::getId());
            }
            if (!method_exists($object, $action)) {
                require_once './app/views/layouts/error.php';
                return false;
            }
            return $object->$action();
        } else {
            require_once './app/views/layouts/error.php';
        }
    }


    public static function getActionMethod($url, $callback)
    {
        call_user_func($callback);
    }


}