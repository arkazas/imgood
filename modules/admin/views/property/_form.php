<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Property $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="property-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>


        <?= $form->field($model, 'datatype_id')->dropDownList($data_types, [
            'style' => 'width:300px', 
            'prompt' => 'Please select base type of data'
        ])?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-info btn-sm']) ?>
		</div>

        <?= $form->field($model, 'entity_id')->hiddeninput()->label('') ?>

	<?php ActiveForm::end(); ?>

</div>
