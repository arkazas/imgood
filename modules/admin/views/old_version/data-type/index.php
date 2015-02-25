<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">

<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['data-type/add']),
    ]);?>

<?= $form->field($model, 'dataTypeName')
    ->textInput(['style' => 'width:300px'])
    ->hint('Name of type for data')
    ->label('Add new type for data:') 
?>

<?= $form->field($model, 'baseTypeName')
    ->dropDownList($baseDataType, ['style' => 'width:300px', 'prompt' => 'Please select base type of data'])
    ->hint('Standart system data type')
    ->label('Select standart datatype :') 
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
if(!empty($types))
{
    echo "<table class = 'table table-striped table-bordered table-hover'";
    echo "<tr>
        <th>Subject Area name</th>
        <th>Base data type</th>
        <th colspan='2' style='text-align: center' >Actions</th></tr>";

    foreach($types as $key => $value)
    {
        echo "<tr><td width='44%'>";
            echo $value['name'];
        echo "</tdr><td width='44%'>";
            echo $value['baseType'];
        echo "</td><td width='6%'>";
        echo Html::a('Edit', Html::url(['data-type/edit', 'id' => $key]), ['class' => 'btn btn-info']);
        echo "</td><td width='6%'>";
        echo Html::a('Delete', Html::url(['data-type/remove', 'id' => $key]), 
            ['class' => 'btn btn-danger', 'onClick' => 'return confirm("Do you want remove this item?") ? true : false;']);
        echo "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p><b>Type of data is not exists</b></p>";
}
?>
</div>