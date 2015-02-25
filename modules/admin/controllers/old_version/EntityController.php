<?php

namespace app\modules\admin\controllers;

use yii;
use app\models\Entity;
use app\models\Property;

class EntityController extends \yii\web\Controller
{
    private $model;

    public function init()
    {
       $this->model = new Entity();
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->model, 
            'properties' => $this->getProperties(),
            'data' => $this->model->getAll(),
        ]);
    }

    private function getProperties()
    {
        $property = new Property();
        $arr = $property->getAll();

        foreach ($arr as $key => $value) 
        {
            $type[$key] = $value['name'];
        }

        return $type;
    }

    public function actionAdd()
    {
        $this->model->add();
        $this->redirect(['entity/index']);
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
        $this->redirect(['entity/index']);
    }

    public function actionRemove()
    {
        $this->model->remove();
        $this->redirect(['entity/index']);
    }
}
