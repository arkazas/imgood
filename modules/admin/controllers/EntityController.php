<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Entity;
use app\models\search\EntitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * EntityController implements the CRUD actions for Entity model.
 */
class EntityController extends Controller
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
	 * Lists all Entity models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new EntitySearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Entity model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id, $type)
	{
		Yii::$app->session['selected_entity_id'] = $id;
		Yii::$app->session['selected_entity_name'] = Entity::findOne($id)->name;

		$this->redirect(["$type/index"]);
	}


	/**
	 * Displays a single Entity model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionViewByArea()
	{
		$area_id = Yii::$app->session['selected_area_id'];

		$dataProvider = new ActiveDataProvider([
    		'query' =>  Entity::find()
    					->select(['entities.id', 'entities.name', 'areas.name as area_name'])
    					->innerJoin('areas', 'areas.id = area_id')
						->where(['area_id' => $area_id])
						,
		]);

		return $this->render('view_by_area', [
			'dataProvider' => $dataProvider,
			'area_id' => $area_id,
		]);
	}

	/**
	 * Creates a new Entity model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($area_id)
	{
		$model = new Entity;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect([
				'view-by-area', 
				'area_id' => $model->area_id,
			]);
		} else {
			return $this->render('create', [
				'model'   => $model,
				'area_id' => $area_id,
			]);
		}
	}

	/**
	 * Updates an existing Entity model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect([
				'view-by-area',
				'id'      => $model->id,
				'area_id' => $model->area_id,
			]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Entity model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$area_id = $model->area_id;
		$model->delete();

		return $this->redirect(['view-by-area', 'area_id' => $area_id,]);
	}

	/**
	 * Finds the Entity model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Entity the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Entity::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
