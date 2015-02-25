<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Property $model
 */

$this->title = 'Update Property: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="property-update">

	<?= $this->render('_form', [
		'model' => $model,
        'data_types' => $data_types,
	]) ?>

</div>
