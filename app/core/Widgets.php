<?php

namespace app\core;

class Widgets
{
	static $model;
	static $options;

	public function __construct()
	{

	}

	public static function listWidget($model, array $rules = null)
	{
		require_once 'vendor/widgets/list.php';
	}


	public static function searchModel($model, $data)
	{
		require_once 'vendor/widgets/listSearchResult.php';
	}



}