<?php

namespace app\core;

use app\core\Session;
use app\core\User;

interface USER_INTERFACE
{
	public static function isGuest();

	public static function checkUser($parameter);

}