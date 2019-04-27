<?php

namespace app\core;

use app\core\USER_INTERFACE;
use app\core\Session;
//use app\core\User;
use app\models\User as UserModel; //

class User implements USER_INTERFACE
{

	public static function isGuest()
	{
		if(Session::getSession()){
			return false;
		}
		return true;
	}


	public static function checkUser($post)
	{	
		$userModel = new UserModel();
		$username = trim($post['username']);

		$user = $userModel->find()->where(['username' => $username])->one();
		if(count($user) > 0){
			if(password_verify($post['password'], $user['password_hash'])){
				foreach($user as $key => $val){
					Session::setSession($key, $val);
				}
				return true;
			}
			return false;
		}	
		return false;

	}

}