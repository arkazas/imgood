<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\AreaSearch $searchModel
 */

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-index">

	<p><?= Html::a('Create Area', ['create'], ['class' => 'btn btn-success btn-sm']) ?></p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			['class' => 'yii\grid\ActionColumn'],
		],
		'tableOptions' => ['class' => 'table table-striped table-bordered table-hovered'],
	]); ?>

</div>
