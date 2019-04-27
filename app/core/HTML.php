<?php

namespace app\core;

use app\config\Params;
use app\core\Helpers;

class HTML
{
    public static $field;
    public static $button;
    public $dropdownList;
    public static $textType = 'text';
    public static $submitType = 'submit';
    public static $buttonType = 'button';
    public static $label;
    public static $attr;
    public static $model;
    public static $file;


    public function __construct()
    {
        // Some codes ././
    }


    /**
     * @param $prop
     * @param $value
     */
    public function __set($prop, $value)
    {

        if (property_exists(new self, $prop)) {
            self::$prop = $value;
        }
    }


    public static function _beginForm()
    {
        $controller = Helpers::getController();
        $action = Helpers::getAction();
        $id = Helpers::getId();

        echo '<form method="POST" action="' . Helpers::Url() . '/' . $controller . '/' . $action . '/' . $id . '" enctype = "multipart/form-data">';
    }


    /**
     *
     */
    public static function _endForm()
    {
        echo '</form>';
    }


    /**
     * @param $model
     * @param $attr
     * @return HTML
     */
    public static function field($model, $attr)
    {
        self::$model = $model;
        self::$attr = $attr;
        $value = '';
        $action = Helpers::getAction();
        if ($action == 'update') {
            $value = $model[self::$attr];
        }
        self::$field =
            "<div class='form-group'>
				<label for='" . self::$attr . "'>" . self::$attr . "</label>
				<input value = '" . $value . "' id='" . self::$attr . "' type='" . self::$textType . "' name='" . $attr . "' class='form-control'>
			</div>";

        return new self;
    }


    /**
     * @param null $options
     * @return mixed
     */
    public function textInput($options = null)
    {
        return self::$field;
    }


    /**
     * @param $arr
     * @return string
     */
    public function dropdownList($arr)
    {
        self::$field = '';
        self::$field .= '<div id = "' . self::$attr . '" class="form-group">
			<label for="' . self::$attr . '">' . self::$attr . '</label>
			<select name="' . self::$attr . '" class="form-control">';

        foreach ($arr as $key => $value) {
            self::$field .=
                '<option value="' . $key . '">' . $value . '</option>';
        }

        self::$field .= '</select></div>';

        return self::$field;
    }


    /**
     * @return string
     */
    public function textArea()
    {
        self::$field = '';
        $value = '';
        $action = Helpers::getAction();
        if ($action == 'update') {
            $value = self::$model[self::$attr];
        }

        self::$field = '<div class="form-group">
							<label for=' . self::$attr . '>' . self::$attr . '</label>
							<textarea id="' . self::$attr . '" name="' . self::$attr . '" class="form-control">' . $value . '</textarea>
						</div>';
        return self::$field;
    }


    /**
     * @return string
     */
    public function fileInput()
    {
        self::$field = '';
        $src = '';

        if (Helpers::getAction() === 'update') {
            $src = self::$model[self::$attr];
        }

        self::$field = '<div class="form-group">
                            <label for=".self::$attr.">' . self::$attr . '</label>
                            <input type="file" id="' . self::$attr . '" name="' . self::$attr . '" class="form-control">
                        </div>';

        if (Helpers::getAction() === 'update') {
            self::$field .= '<div class="form-group">
                                <img width="200" height="200" class="img-responsive" src="../../../' . $src . '" alt="' . self::$model[self::$attr] . '">
                             </div>';
        }
        return self::$field;
    }


    /**
     * @param array $options
     * @return string
     */
    public static function button($options = [])
    {
        if (!empty($options)) {
            self::$button =
                "<div class='form-group'>
				<input type=" . self::$submitType . " class='" . $options['class'] . "' id='" . $options['id'] . "' value = '" . $options['value'] . "'>
			</div>";
        } else {
            self::$button = "<div class='form-group'>
								<input type=" . self::$submitType . " class='btn btn-default' value='Save'>
							</div>";
        }
        return self::$button;
    }


    /**
     * @param $model
     * @param array $attributes
     * @return string
     */
    public static function multiLanguage($model, $attributes = [])
    {
        $active = '';
        $output = '';
        $nav_tabs = '';
        $nav_lang = '';
        $nav_lang_item = '';
        $languages = Params::$languages;

        $output = '<hr>
            <div id="exTab2" class="container-fluid">
            <div class="row">
                <ul class="nav nav-tabs">';

        $i = 0;
        foreach ($languages as $lang) {
            if ($i == 0) {
                $active = 'active';
            } else {
                $active = '';
            }
            $nav_tabs .= '
                        <li class="' . $active . '">
                            <a href="#' . $i . '" data-toggle="tab">' . $lang . '</a>
                         </li>';
            $i++;
        }

        $output .= $nav_tabs . '</ul></div><div class="tab-content">';

        $i = 0;
        foreach ($languages as $lang) {
            if ($i == 0) {
                $active = 'active';
            } else {
                $active = '';
            }
            $nav_lang .= '<div class="tab-pane ' . $active . '" id="' . $i . '">';
            foreach ($attributes as $key => $val) {

                $nav_lang_item .= '
                            <div class="form-group">
                                <label for="title-az">' . $key . '</label>
                                <input type="text" placeholder="' . $key . '" class="form-control ' . $val["class"] . '" id="' . $val["id"] . '" name="' . $key . "[" . $lang . "]" . '">
                            </div>';
            }

            $nav_lang .= $nav_lang_item . '</div>';
            $nav_lang_item = '';
            $i++;

        }
        $nav_lang .= '</div></div></div><hr>';
        $output .= $nav_lang;

        return $output;
    }


}