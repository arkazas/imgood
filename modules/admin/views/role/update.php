<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Role $model
 */

$this->title = 'Update Role: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-update">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
