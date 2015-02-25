<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">
<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['property/update']),
    ]);?>

<?= $form->field($model, 'propertyName')
    ->textInput(['style' => 'width:400px', 'value' => $name[0]['name']])
    ->label('Edit property:') 
?>

<?= $form->field($model, 'propertyType')
    ->dropDownList($types, ['style' => 'width:300px', 'prompt' => 'Please select base type of data'])
    ->label('Select type of data :') 
?>

<?= $form->field($model, 'id')
    ->input('hidden', ['value' => $name[0]['_id']])
    ->label('') 
?>

<div class="form-group">
        <div class="col-lg">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Back', ['property/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
</div><!-- SubjectArea -->