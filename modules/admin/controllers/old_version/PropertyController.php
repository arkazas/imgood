<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Property;
use app\models\DataType;

class PropertyController extends \yii\web\Controller
{
    private $model;

    public function init()
    {
       $this->model = new Property();
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->model, 
            'properties' => $this->model->getAll(),
            'types' => $this->getDataTypes(),
            'data' => $this->model->getAll(),
        ]);
    }

    private function getDataTypes()
    {
        $types = new DataType();
        $arr = $types->getAll();

        foreach ($arr as $key => $value) 
        {
            $type[$key] = $value['name'];
        }

        return $type;
    }

    public function actionAdd()
    {
        $this->model->add();
        $this->redirect(['property/index']);
    }

    public function actionEdit()
    {
        if(Yii::$app->request->isGet)
        {
            return $this->render('edit', [
                'name' => $this->model->getOne(), 
                'model' => $this->model,
                'types' => $this->getDataTypes(),
            ]);
        }
    }

    public function actionUpdate()
    {
        $this->model->update();
        $this->redirect(['property/index']);
    }

    public function actionRemove()
    {
        $this->model->remove();
        $this->redirect(['property/index']);
    }
}
