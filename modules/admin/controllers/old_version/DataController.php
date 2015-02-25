<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Data;
use app\models\Entity;
use app\models\Property;

class DataController extends \yii\web\Controller
{

    private $model;

    private $entity;

    private $property;    

    public function init()
    {
       $this->model = new Data();
       $this->entity = new Entity();
       $this->property = new Property();
    }

    public function actionIndex()
    {
        $data = $this->model->getAll();

        return $this->render('index', [
            'model' => $this->model,
            'data' => $data,
            'baseDataType' => $this->model->getBaseDataType(),
            'entity' => $this->entity->getAll(),
            'property' => $this->property->getAll(),
        ]);
    }

    public function actionAdd()
    {
        $this->model->add();
        $this->redirect(['data/index']);
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
        $this->redirect(['data/index']);
    }

    public function actionRemove()
    {
        $this->model->remove();
        $this->redirect(['data/index']);
    }
}
