<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Entity $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="entity-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
            <?= Html::a('Back', ['view-by-area', 'area_id' => $area_id], ['class' => 'btn btn-info btn-sm']) ?>
		</div>
        
        <?= $form->field($model, 'area_id')->input('hidden', ['value' => $area_id])->label('') ?>
	<?php ActiveForm::end(); ?>
</div>