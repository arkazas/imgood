<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Data;
use app\models\Property;
use app\models\search\DataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataController implements the CRUD actions for Data model.
 */
class DataController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Data models.
     * @return mixed
     */
    public function actionIndex()
    {
        $result = [];
        $data = Data::getAllList();

        foreach ($data as $key => $value) {
            $result[$value['id']][] = $value;
        }

        //var_dump($result);die;
        
        $searchModel = new DataSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'data' => $result,
        ]);
    }

    /**
     * Displays a single Data model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Data model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Data;

        $id = $model->getLastID();

        if (Yii::$app->request->post()) {
            
            $ppost = Yii::$app->request->post();

            unset($ppost['_csrf']);

            foreach ($ppost as $key => $value) {

                $data_model = new Data;

                $data_model->entity_id = Yii::$app->session['selected_entity_id'];
                $data_model->property_id = $key;
                $data_model->value = $value;
                $data_model->id = $id + 1;

                $data_model->insert();

                unset($data_model);
            }

            return $this->redirect(['index', 'id' => $model->id]);
        } else {

            $model->properties_list = Property::getListByEntity(Yii::$app->session['selected_entity_id']);

            /*foreach ($properties_list as $key => $value) {
                $setting = 'property_' . $key;
                $model->$setting = '';
            }*/


            return $this->render('create', [
                'model' => $model,
                //'properties_list' => Property::getListByEntity(Yii::$app->session['selected_entity_id']),
            ]);
        }
    }

    /**
     * Updates an existing Data model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new Data;
        $data = $model->getById($id);

        if (Yii::$app->request->post()) {

            $ppost = Yii::$app->request->post();

            unset($ppost['_csrf']);

            foreach ($ppost as $key => $value) {
                $data_model = new Data;

                $data_model->entity_id = Yii::$app->session['selected_entity_id'];
                $data_model->setIsNewRecord(false);
                $data_model->property_id = $key;
                $data_model->value = $value;
                $data_model->id = $id;

                $data_model->update()->where("id = $id and property_id = $key");
                var_dump($data_model->errors); die('ssss');

                unset($data_model);
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'data' => $data,
            ]);
        }
    }

    /**
     * Deletes an existing Data model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionRemove($id)
    {
        $model = new Data;
        $model->deleteById($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Data model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Data the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Data::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
