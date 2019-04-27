<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Uploads;
use app\core\Widgets;
use app\models\Blogs;
use app\core\Helpers;

class blogsController extends Controller
{

    /**
     * Rendered index
     */
    public function actionIndex()
	{
		$model = new Blogs();
		return $this->render('index', [
			'model' => $model,
		]);
	}



    /**
     * Rendered create
     */
    public function actionCreate()
	{
		$model = new Blogs();
		$post = $this->request->post();

		if($post){
            if(isset($_FILES['image']) && !empty($_FILES['image'])){
                $file = $_FILES['image'];
                $allow = ['jpg', 'jpeg', 'png', 'gif'];

                //Upload image ..
                $uploads = new Uploads();
                $uploads->filePrepare($file,
                    ['minSize' => 500,
                     'maxSize' => 1000000,
                     'allow' => $allow,
                     'destination' => './media/uploads/',
                    ]);
                $model->image = $uploads->getFileDestination();
            }

            // for save database ...
            $model->title = $post['title'];
			$model->short = $post['short'];
			$model->description = $post['description'];

            if($model->save()){
				return $this->redirect('index');
			}

		}else{

			$model = new Blogs();
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
		$model = new Blogs();
		$post = $this->request->post();

		if($post){
            if(isset($_FILES) && !empty($_FILES)){
                $file = $_FILES['image'];
                $allow = ['jpg', 'jpeg', 'png', 'gif'];
                $uploads = new Uploads();

                $uploads->filePrepare($file,
                    [
                        'minSize' => 500,
                        'maxSize' => 1000000,
                        'allow' => $allow,
                        'destination' => './media/uploads/',
                    ]);
                // delete old image from self folder ..
                $oldImage = $model->find()->where(['id' => $id])->one()['image'];

                unlink($oldImage);
                $model->image = $uploads->getFileDestination();
            }

			// Data for updated model ..
			$model->title = $post['title'];
			$model->short = $post['short'];
			$model->description = $post['description'];

			if($model->save()){
				return $this->redirect('index');
			}

		}else{
			$model = $model->find()->where(['id' => $id])->one();
			return $this->render('update', [
				'model' => $model,
			]);
		}

	}
	


    /**
     * @param $id
     */
    public function actionView($id)
	{
		$model = new Blogs();
		$blogs = $model->find()->where(['id' => $id])->one();

		return $this->render('view', [
			'blogs' => $blogs,
		]);
	}

    //This method for example ajax method ..(media/js/main.js)
	public function actionAjax()
    {
        echo 'Ajax method successfully!';die();
    }




    /**
     * @param $id
     */
    public function actionDelete($id)
	{
		$model = new Blogs();

		if($model->delete()){
			return $this->redirect('index');
		}
	}



    /**
     * @param null $data
     */
	public function actionSearchModel($data = null){
        $model = new Blogs();

		Widgets::searchModel($model, $data);
	}


}