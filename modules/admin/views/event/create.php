<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Event $model
 */

$this->title = 'Create Event';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
