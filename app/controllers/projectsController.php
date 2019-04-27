<?php

namespace app\controllers;


use app\core\Controller;
use app\core\Helpers;
use app\core\Uploads;
use app\core\Widgets;
use app\models\Projects;

class ProjectsController extends Controller
{

    public function actionIndex()
    {
        $model = new Projects();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new Projects();
        $post = $this->request->post();
        if ($post) {
            //Check file
            if (isset($_FILES["image"]) && !empty($_FILES["image"])) {
                $file = $_FILES["image"];
                $allow = ["jpg", "png", "gif", "jpeg"];

                //Upload file
                $uploads = new Uploads();
                $uploads->filePrepare($file, [
                   'minSize' => 500,
                   'maxSize' => 1000000,
                   'allow' => $allow,
                   'destination' => './media/uploads',
                ]);
                $model->image = $uploads->getFileDestination();
                $model->created_at = time();
                $model->admin_id = Helpers::getUser()['id'];
                $model->title = $post["title"];
                $model->short = $post["short"];
                $model->description = $post["description"];

                if($model->save()){
                    return $this->redirect('index');
                }
            }
        } else {
            $model = new Projects();
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }


    /**
     * @param $id
     */
    public function actionUpdate($id)
    {

    }


    /**
     * @param $id
     */
    public function actionView($id)
    {

    }


    /**
     * @param $id
     */
    public function actionDelete($id)
    {

    }


    /**
     * @param null $data
     */
    public function actionSearchModel($data = null)
    {
        $model = new Projects();
        Widgets::searchModel($model, $data);

    }


}