<?php

namespace app\core;

use app\core\Router;
use app\core\Helpers;

class Layouts
{

    private function __construct()
    {
    }


    public static function Head($url)
    {
        $router = new Router($url);
        return $router->goHome($url);
    }


    public static function Main($url)
    {
        $router = new Router($url);
        $router->view($url);

    }


    public static function Foot($url)
    {
        $router = new Router($url);
        return $router->goHome($url);
    }


    public static function LoginRequired()
    {
        $router = new Router();
        $router->view('site/login');
    }


    public static function breadCrumbs(array $arr = [])
    {
        $controller = Helpers::getController();
        $action = Helpers::getAction();

        echo "<p class='alert alert-info'>
				<a href=' ". Helpers::Url() . "/site/index'>Home</a> /
				<a href='". Helpers::Url() . '/'. $controller . '/' . 'index' . "'>" . $controller . "</a> / 
				<span>" . $action . "</span>
			  </p>";

    }

}