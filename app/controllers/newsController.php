<?php

namespace app\controllers;


use app\core\Controller;
use app\core\Helpers;
use app\core\Widgets;
use app\models\News;

class newsController extends Controller
{

    /**
     *
     */
    public function actionIndex()
	{
		$model = new News();

		return $this->render('index',[
			'model' => $model,
		]);

	}


    /**
     *
     */
    public function actionCreate()
	{
		$model = new News();
		$post = $this->request->post();

		if($post){

			Helpers::Dump($post);die();
			return $this->redirect('index');
			
		}else{

			return $this->render('create',[
				'model' => $model,
			]);

		}

	}


    /**
     * @param $id
     */
    public function actionUpdate($id)
    {
        $model = new News();
        $post = $this->request->post();

        if($post){
            Helpers::Dump($post);die();


        }else{
            $model = $model->find()->where(['id' => $id])->one();
            return $this->render('update', [
                'model' => $model,
            ]);



        }

    }


    /**
     * @param null $data
     */
    public function actionSearchModel($data = null)
	{
		$model = new News();
		Widgets::searchModel($model, $data);
	}




}