<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Uploads;
use app\models\Products;
use app\core\Helpers;
use app\core\Widgets;


class productsController extends Controller
{
    public function actionIndex()
    {
        $model = new Products();

        return $this->render('index', [
            'model' => $model,
        ]);
    }


    public function actionCreate()
    {
        $model = new Products();
        $post = $this->request->post();

        if ($post) {
            if (isset($_FILES['image']) && !empty($_FILES['image'])) {
                $uploads = new Uploads();
                $file = $_FILES['image'];
                $allow = ['jpg', 'jpeg', 'png', 'png'];

                $uploads->filePrepare($file, [
                    'minSize' => 500,
                    'maxSize' => 1000000,
                    'allow' => $allow,
                    'destination' => './media/uploads/'
                ]);
                $model->image = $uploads->getFileDestination();
            }


            // data for save model ..
            $model->name = $post['name'];
            $model->short = $post['short'];
            $model->description = $post['description'];
            $model->price = $post['price'];
            $model->status = $post['status'];
            $model->created_at = time();
            $model->name = $post['name'];

            if ($model->save()) {
                return $this->redirect('index');
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }


    public function actionUpdate($id)
    {
        $model = new Products();
        $post = $this->request->post();

        if ($post) {
            if(isset($_FILES['image']) && !empty($_FILES['image'])){
                $uploads = new Uploads();
                $file = $_FILES['image'];

                $uploads->filePrepare($file, [
                    'minSize' => 500,
                    'maxSize' => 1000000,
                    'allow' => ['jpg', 'jpeg', 'png', 'gif'],
                    'destination' => './media/uploads/'
                ]);
                $model->image = $uploads->getFileDestination();

                //delete old image ..
                $old_image = $model->find()->where(['id' => $id])->one()['image'];
                unlink($old_image);
            }

            // For save to database ..
            $model->name = $post['name'];
            $model->short = $post['short'];
            $model->description = $post['description'];
            $model->status = $post['status'];
            $model->price = $post['price'];
            $model->updated_at = time();

            if ($model->save()) {
                return $this->redirect('index');
            }


        } else {
            $model = $model->find()->where(['id' => $id])->one();

            return $this->render('update', [
                'model' => $model,
            ]);


        }
    }

    public function actionView($id)
    {
        $model = new Products();
        $model = $model->find()->where(['id' => $id])->one();

        return $this->render('view', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $model = new Products();
        if($model->delete()){
            return $this->redirect('index');
        };
    }


    public function actionSearchModel($data = null)
    {
        $model = new Products();
        Widgets::searchModel($model, $data);
    }


}