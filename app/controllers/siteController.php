<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Session;
use app\core\Helpers;
use app\core\User;

class siteController extends Controller
{
	public function actionIndex()
	{
		$model = 'Model';
		$user = 'User';

		return $this->render('index', [
			'model' => $model,
			'user' => $user,

		]);
	}


	public function actionLogin()
	{	
		$post = $this->request->post();
		if($post){
			if(User::checkUser($post)){
				return $this->redirect('index');
			}else{
				return $this->redirect('login');
			}
		}else{
			return $this->render('login');
		}
	}



	public function actionLogout()
	{
		return $this->render('logout');
	}

}