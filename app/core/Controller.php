<?php

namespace app\core;

use app\core\Request;
use app\core\User;


class Controller
{
	protected static $className;
	public $assetName;
	public $request;

	public function __construct()
	{
		$this->request = new Request();
	}

	public function render($url, array $array = [])
	{	
		$this->request = $this;

		foreach ($array as $key => $value) {
			$$key = $value;
		}

		$controller = $_GET['controller'];

		if(!$controller){

			if(User::isGuest()){
				require_once "app/views/site/login.php";
			}else{
				require_once "app/views/site/index.php";
			}
		}else{
			if(User::isGuest()){
				$controller = 'site';
			}
			require_once "app/views/{$controller}/{$url}.php";
		}
	}




	public function redirect($url)
	{
		Router::_header($url);
	}



	public function title()
	{
		return Helpers::getController();
	}


}



