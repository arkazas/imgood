<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Event;
use app\models\Property;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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
	 * Lists all Event models.
	 * @return mixed
	 */
	public function actionIndex()
	{

    	$dataProvider = new ActiveDataProvider([
            'query' =>  Event::find()
                        ->select([
                        	'id',
                            'name', 
                        ])
                        ->where(['entity_id' => Yii::$app->session['selected_entity_id']]),
        ]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'entity_name'  => Yii::$app->session['selected_entity_name'],
		]);
	}

	/**
	 * Displays a single Event model.
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
	 * Creates a new Event model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Event;
		$model->entity_id = Yii::$app->session['selected_entity_id'];
		$model->property_list = Property::getListByEntity($model->entity_id);

		if ($model->load(Yii::$app->request->post())) {
			$model->property_ids = serialize($model->property_ids);
			
			$model->save();
			
			return $this->redirect(['index', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Event model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$model->property_ids = unserialize($model->property_ids);
		$model->property_list = Property::getListByEntity($model->entity_id);

		if ($model->load(Yii::$app->request->post())) {
			$model->property_ids = serialize($model->property_ids);
			
			$model->save();
			
			return $this->redirect(['index', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Event model.
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
	 * Finds the Event model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Event the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Event::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
