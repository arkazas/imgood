<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\EventSearch $searchModel
 */

$this->title = 'Events - ' . $entity_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

	<p>
		<?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
		<?= Html::a('Back', ['entity/view-by-area'], ['class' => 'btn btn-info btn-sm']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			['class' => 'yii\grid\ActionColumn', 
			'template' => '{update} {delete}', ],
		],
	]); ?>

</div>
