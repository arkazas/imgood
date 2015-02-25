<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Property;
use app\models\DataType;
use app\models\search\PropertySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller
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
	 * Lists all Property models.
	 * @return mixed
	 */
	public function actionIndex()
	{
        $dataProvider = new ActiveDataProvider([
            'query' =>  Property::find()
                        ->select([
                            'properties.id', 
                            'properties.name', 
                            'entities.name as entity_id',
                            'datatypes.name as datatype_name'
                        ])
                        ->innerJoin('entities', 'entities.id = entity_id')
                        ->innerJoin('datatypes', 'datatypes.id = datatype_id')
                        ->where(['entity_id' => Yii::$app->session['selected_entity_id']]),
        ]);

		/*$searchModel = new PropertySearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());*/

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'entity_name'  => Yii::$app->session['selected_entity_name'],
		]);
	}

	/**
	 * Displays a single Property model.
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
	 * Creates a new Property model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Property;
		$model->entity_id = Yii::$app->session['selected_entity_id'];

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
                'data_types' => $this->getDataTypesList(),
			]);
		}
	}

    /**
     * Getting datatype list from DataType model.
     * @return array
     */
    public function getDataTypesList()
    {
        return DataType::getDataTypesList();
    }


	/**
	 * Updates an existing Property model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
                'data_types' => $this->getDataTypesList(),
			]);
		}
	}

	/**
	 * Deletes an existing Property model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Property model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Property the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Property::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
