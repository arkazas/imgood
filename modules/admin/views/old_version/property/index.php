<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">

<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['property/add']),
    ]);?>

<?= $form->field($model, 'propertyName')
    ->textInput(['style' => 'width:400px'])
    ->label('Add new propety name :') 
?>

<?= $form->field($model, 'propertyType')
    ->dropDownList($types, ['style' => 'width:300px', 'prompt' => 'Please select base type of data'])
    ->label('Select type of data :') 
?>

<div class="form-group">
        <div class="col-lg">
            <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
</div><!-- SubjectArea -->

<div style="margin-top: 80px;">


<?php
if(!empty($data))
{
    echo "<table class = 'table table-bordered table-striped '";
    echo "<tr><th>Property name</th><th>Type</th><th colspan='2' style='text-align: center' >Actions</th></tr>";

    foreach($data as $key => $value)
    {
        echo "<tr><td width='44%'>";
            echo $value['name'];
        echo "</td><td width='44%'>";
            echo $types[$value['type_id']];
        echo "</td><td width='6%'>";
        echo Html::a('Edit', Html::url(['property/edit', 'id' => $key]), ['class' => 'btn btn-info']);
        echo "</td><td width='6%'>";
        echo Html::a('Delete', Html::url(['property/remove', 'id' => $key]), 
            ['class' => 'btn btn-danger', 'onClick' => 'return confirm("Do you want remove this item?") ? true : false;']);
        echo "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p><b>Properties is not exists</b></p>";
}
?>
</div>