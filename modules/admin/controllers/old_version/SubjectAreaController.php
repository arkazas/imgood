<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SubjectArea;

class SubjectAreaController extends \yii\web\Controller
{

    private $model;

    public function init()
    {
       $this->model = new SubjectArea();
    }

    public function actionIndex()
    {
        $data = $this->model->getAll();

        return $this->render('index', ['areas' => $data, 'model' => $this->model]);
    }

    public function actionAdd()
    {
        $this->model->add();
        $this->redirect(['subject-area/index']);
    }

    public function actionEdit()
    {
        if(Yii::$app->request->isGet)
        {
            return $this->render('edit', ['name' => $this->model->getOne(), 'model' => $this->model]);         
        }
    }

    public function actionUpdate()
    {
        $this->model->update();
        $this->redirect(['subject-area/index']);
    }

    public function actionRemove()
    {
        $this->model->remove();
        $this->redirect(['subject-area/index']);
    }
}
