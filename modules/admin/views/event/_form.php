<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Event $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-form">

	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

	    <?= $form->field($model, 'property_ids')->dropDownList($model->property_list, [
            'style' => 'width:300px', 
            'multiple' => true,
            'prompt' => 'Please select properties for event'
        ])?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-info btn-sm']) ?>
		</div>

		<?= $form->field($model, 'entity_id')->hiddeninput()->label('') ?>

	<?php ActiveForm::end(); ?>

</div>
