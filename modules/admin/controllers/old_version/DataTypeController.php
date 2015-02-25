<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\DataType;

class DataTypeController extends \yii\web\Controller
{

    private $model;

    public function init()
    {
       $this->model = new DataType();
    }

    public function actionIndex()
    {
        $data = $this->model->getAll();

        return $this->render('index', ['model' => $this->model, 'types' => $data, 'baseDataType' => $this->model->getBaseDataType()]);
    }

    public function actionAdd()
    {
        $this->model->add();
        $this->redirect(['data-type/index']);
    }

    public function actionEdit()
    {
        if(Yii::$app->request->isGet)
        {
            return $this->render('edit', ['name' => $this->model->getOne(), 'model' => $this->model, 'baseDataType' => $this->model->getBaseDataType()]);         
        }
    }

    public function actionUpdate()
    {
        $this->model->update();
        $this->redirect(['data-type/index']);
    }

    public function actionRemove()
    {
        $this->model->remove();
        $this->redirect(['data-type/index']);
    }
}
