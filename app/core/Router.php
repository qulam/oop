<?php

namespace app\core;

use app\config\Params;
use app\core\URL_MANAGER;

class Router
{
    public static $url;
    protected static $prettyUrl;
    protected static $className;

    public function __construct($url = null)
    {
        self::$url = $url;
        self::$prettyUrl = Params::ParamsConfig();

        foreach (self::$prettyUrl['rules'] as $key => $value) {
            if ($key == self::$url) {
                self::$url = $value;
            }

        }
    }


    public function view($url)
    {
        self::$url = $url;

        new URL_MANAGER($url);

        URL_MANAGER::getActionMethod($url, function () {
            return URL_MANAGER::actionMethod(self::$url);
        });
    }


    public function goHome($url)
    {
        if($_SERVER["REQUEST_METHOD"] === 'POST'){
            if(Helpers::isAjax()){
                $query_string = $_SERVER['QUERY_STRING'];
                $request_uri = $_SERVER['REQUEST_URI'];

                $exp_general = explode('&', $query_string);
                foreach($exp_general as $val){
                    if(strstr($val, 'controller', 0)){
                        $controller = explode('=', $val)[1];
                    }

                    if(strstr($val, 'action', 0)){
                        $action = explode('=', $val)[1];
                    }
                }
                $controller = $controller . 'Controller';
                $action = explode('/', $request_uri);
                $count = count($action);
                $action = $action[$count - 1];
                $action = 'action' . $action;

                URL_MANAGER::actionControllerMethod($controller, $action);
            }
        }
        if (file_exists("app/views/layouts/{$url}.php")) {
            require_once "app/views/layouts/{$url}.php";
        }
    }


    public static function get($url, $callback)
    {
        call_user_func($callback);
    }

    public static function _header($url)
    {

        $controller = Helpers::getController();
        echo "<script>window.location.href='" . Helpers::Url() . "/" . $controller . "/" . $url . "'</script>";

    }


}