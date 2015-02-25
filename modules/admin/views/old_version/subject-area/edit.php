<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">
<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['subject-area/update']),
    ]);?>

<?= $form->field($model, 'subjectAreaName')
    ->textInput(['style' => 'width:400px', 'value' => $name[0]['name']])
    ->hint('Input subject area name')
    ->label('Edit subject area:') 
?>

<?= $form->field($model, 'id')
    ->input('hidden', ['value' => $name[0]['_id']])
    ->label('') 
?>

<div class="form-group">
        <div class="col-lg">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Back', ['subject-area/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
</div><!-- SubjectArea -->