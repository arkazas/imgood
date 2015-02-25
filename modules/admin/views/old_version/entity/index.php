<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">

<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['entity/add']),
    ]);?>

<?= $form->field($model, 'entityName')
    ->textInput(['style' => 'width:400px'])
    ->label('Add new entity :') 
?>

<?= $form->field($model, 'propertyType')
    ->listBox($properties, ['style' => 'width:300px', 'multiple' => true])
    ->label('Select properties for entity :') 
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
    echo "<tr><th>Property name</th><th>Properties</th><th colspan='2' style='text-align: center' >Actions</th></tr>";

    foreach($data as $key => $value)
    {
        echo "<tr><td width='44%'>";
            echo $value['name'];
        echo "</td><td width='44%'>";
        
        foreach ($value['property_id'] as $pkey => $property_id) {
            echo $properties[$property_id] . '<br />';
        }
        echo "</td><td width='6%'>";
        echo Html::a('Edit', Html::url(['entity/edit', 'id' => $key]), ['class' => 'btn btn-info']);
        echo "</td><td width='6%'>";
        echo Html::a('Delete', Html::url(['entity/remove', 'id' => $key]), 
            ['class' => 'btn btn-danger', 'onClick' => 'return confirm("Do you want remove this item?") ? true : false;']);
        echo "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p><b>Entities is not exists</b></p>";
}
?>
</div>