<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\DataType $model
 */

$this->title = 'Update Data Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Data Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-type-update">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
