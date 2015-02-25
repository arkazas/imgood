<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Property $model
 */

$this->title = 'Create Property';
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-create">

	<?= $this->render('_form', [
		'model' => $model,
        'data_types' => $data_types,
	]) ?>

</div>
