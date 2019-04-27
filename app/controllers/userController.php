<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;
use app\core\Widgets;
use app\core\Helpers;

class userController extends Controller
{

	public function actionIndex()
	{
		$model = new User();

		return $this->render('index', [
			'model' => $model,
		]);
	}



	public function actionCreate()
	{
		$model = new User();
		$post = $this->request->post();

		if($post){
			if($model->isValid($post)){
				$model = $model->isValid($post);
				
				if($model->save()){
					return $this->redirect('index');
				}
			}else{
				return $this->render('create');
			}

		}else{
			return $this->render('create', [
				'model' => $model,
			]);
		}

	}



	public function actionUpdate($id)
	{
		$model = new User();
		$post = $this->request->post();

		if($post){
			if($model->userUpdate($post)){
				$model = $model->userUpdate($post);
				
				if($model->save()){
					return $this->redirect('index');
				}
			}

		}else{
			$model = $model->find()->where(['id' => $id])->one();
			return $this->render('update', [
				'model' => $model,
			]);

		}

	}




	public function actionView($id)
	{
		$model = new User();
		$user = $model->find()->where(['id' => $id])->one();

		return $this->render('view', [
			'user' => $user,
		]);
	}




	public function actionDelete($id)
	{
		$model = new User();

		if($model->delete()){
			return $this->redirect('index');
		};
	}




	public function actionSearchModel($data = null)
	{
		$model = new User();
		Widgets::searchModel($model, $data);
	}




}



