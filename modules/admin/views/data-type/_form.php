<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\DataType $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="data-type-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'base_type')->textInput(['maxlength' => 20]) ?>

		<?= $form->field($model, 'condition')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'default')->textInput(['maxlength' => 255]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-info btn-sm']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
