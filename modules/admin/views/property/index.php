<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\PropertySearch $searchModel
 */

$this->title = 'Properties - ' . $entity_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index">

	<p>
		<?= Html::a('Create Property', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
		<?= Html::a('Back', ['entity/view-by-area'], ['class' => 'btn btn-info btn-sm']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			'datatype_name',

			['class' => 'yii\grid\ActionColumn', 
			'template' => '{update} {delete}', ],
		],
	]); ?>

</div>
