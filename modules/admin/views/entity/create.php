<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Entity $model
 */

$this->title = 'Create Entity';
$this->params['breadcrumbs'][] = ['label' => 'Entities', 'url' => ['view-by-area']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-create">

	<?= $this->render('_form', [
		'model'   => $model,
        'area_id' => $area_id,
	]) ?>

</div>
