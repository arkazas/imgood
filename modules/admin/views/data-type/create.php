<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\DataType $model
 */

$this->title = 'Create Data Type';
$this->params['breadcrumbs'][] = ['label' => 'Data Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-type-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
