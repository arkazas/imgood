<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\EntitySearch $searchModel
 */

$this->title = 'Entities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-index">
	<p>
		<?= Html::a('Create Entity', ['create', 'area_id' => $area_id], ['class' => 'btn btn-success btn-sm']) ?>
		<?= Html::a('Back', ['area/index'], ['class' => 'btn btn-info btn-sm']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			'area_name',
			['class' => 'yii\grid\ActionColumn',
				'template' => '{property} {update} {delete} {events}', 
				'buttons' => [
					'property' => function($url, $model){ 
						return Html::a('', [
							'view', 
							'id' => $model->getAttribute('id'),
							'type' => 'property'
							], ['class' => 'glyphicon glyphicon-search', 'title' => 'View properties']
						);
					},
					'events'   => function($url, $model){ 
						return Html::a('', [
							'view', 
							'id' => $model->getAttribute('id'),
							'type' => 'event'
							], ['class' => 'glyphicon glyphicon-flag', 'title' => 'View events']
						);
					},
				]
			],
		],
	]); ?>

</div>
