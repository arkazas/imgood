<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Language;

class LanguageController extends \yii\web\Controller
{

    private $model;

    public function init()
    {
       $this->model = new Language();
    }

    public function actionIndex()
    {
        $data = $this->model->getAll();

        return $this->render('index', ['model' => $this->model, 'data' => $data]);
    }

    public function actionAdd()
    {
        $this->model->add();
        $this->redirect(['language/index']);
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
        $this->redirect(['language/index']);
    }

    public function actionRemove()
    {
        $this->model->remove();
        $this->redirect(['language/index']);
    }
}
