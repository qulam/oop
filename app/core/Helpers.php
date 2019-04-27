<?php

namespace app\core;

use app\config\Params;
use app\core\Session;

class Helpers
{
    public static $url;

    public static function getAction()
    {
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $action = $_GET['action'];
        }

        return $action;
    }

    public static function getController()
    {
        if (isset($_GET['controller']) && !empty($_GET['controller'])) {
            $controller = $_GET['controller'];
        }

        return $controller;
    }


    public static function getId()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            return $_GET['id'];
        }
        return false;
    }


    public static function getUser()
    {
        return Session::getSession();
    }


    public static function Dump($par)
    {
        echo "<pre>";
        print_r($par);
    }


    public static function Url()
    {
        $server_name = $_SERVER['SERVER_NAME'];
        $http = 'http://';
        $request_uri = $_SERVER['REQUEST_URI'];

        $root = $http . $server_name . '/oop/' . $_GET['lang'];
        return $root;
    }


    public static function isAjax()
    {
        $request = apache_request_headers();
        if (isset($request['X-Requested-With']) && $request['X-Requested-With'] == 'XMLHttpRequest') {
            return true;
        }
        return false;
    }

    public static function getLang()
    {
        if(isset($_GET["lang"])){
            if(!empty($_GET["lang"])){
                return $_GET["lang"];
            }
            return Params::$defaultLang;
        }
    }

}