<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\DataTypeSearch $searchModel
 */

$this->title = 'Data Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-type-index">
	<p>
		<?= Html::a('Create Data Type', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
		<?= Html::a('Back', ['property/index'], ['class' => 'btn btn-info btn-sm']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			'base_type',
			'condition',
			'default',
			['class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}', 
			],
		],
	]); ?>

</div>
