<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">
<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['data-type/update']),
    ]);?>

<?= $form->field($model, 'subjectAreaName')
    ->textInput(['style' => 'width:400px', 'value' => $name[0]['name']])
    ->hint('Name of type for data')
    ->label('Edit data type value') 
?>

<?= $form->field($model, 'baseTypeName')
    ->dropDownList($baseDataType, ['style' => 'width:300px', 'prompt' => 'Please select base type of data', 'options' => ['int' => ['selected' => true]]])
    ->hint('Standart system data type')
    ->label('Select standart datatype :') 
?>

<?= $form->field($model, 'id')
    ->input('hidden', ['value' => $name[0]['_id']])
    ->label('') 
?>

<div class="form-group">
        <div class="col-lg">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Back', ['data-type/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
</div><!-- SubjectArea -->