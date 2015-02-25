<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Entity $model
 */

$this->title = 'Update Entity: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Entities', 'url' => ['view-by-area']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entity-update">

	<?= $this->render('_form', [
		'model'   => $model,
        'area_id' => $model->area_id,
	]) ?>

</div>
