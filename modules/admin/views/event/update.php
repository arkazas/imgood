<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Event $model
 */

$this->title = 'Update Event: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-update">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
