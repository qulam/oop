<?php

namespace app\core;

use app\core\HTML;

class ActiveForm extends HTML
{
    public function __construct()
    {

    }


    static function begin()
    {
        return HTML::_beginForm();
    }


    static function end()
    {
        return HTML::_endForm();
    }



}
