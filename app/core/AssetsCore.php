<?php

use app\core\Helpers;

class AssetsCore
{

	public static function registerAssets($assetName = null)
	{
		$assetClass = new $assetName();
		$assets = [];

		foreach($assetClass->css as $key => $css){
			$assets['css'][$key] = $css;
		}

		foreach ($assetClass->js as $key => $js) {
			$assets['js'][$key] = $js;
		}

		//registered Assets ..
		$i = 0;
		foreach ($assets['css'] as $key => $value) {
			$cssAssets = '<link rel="stylesheet" type="text/css" href="'. $assets["css"][$i] . '">';
			echo $cssAssets;
			$i++;
		}

		$i = 0;
		foreach ($assets['js'] as $key => $value) {
			$cssAssets = '<script type="text/javascript" src="' . $assets["js"][$i] . '"></script>';
			echo $cssAssets;
			$i++;
		}

	}



}