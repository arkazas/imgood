<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Area $model
 */

$this->title = 'Update Area: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="area-update">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
