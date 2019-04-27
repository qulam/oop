<?php

namespace app\core;

class Session
{

    public function __construct()
    {

    }


    public static function setSession($name, $value)
    {
        return $_SESSION[$name] = $value;
    }


    public static function getSession($session_name = null)
    {
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            if ($session_name == null) {
                return $_SESSION;

            } else {
                if (isset($_SESSION[$session_name]) && !empty($_SESSION[$session_name])) {
                    return $_SESSION[$session_name];
                } else {
                    return false;
                }
            }

        } else {
            return false;
        }
    }


}