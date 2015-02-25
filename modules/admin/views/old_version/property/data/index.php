<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">

<?php
foreach ($entity as $key => $value) {
    echo " Add data for entity <b>{$value['name']} </b> : <br />";

    $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['data/add']),
    ]);

    foreach ($property as $p_key => $p_value) {
        if(in_array($p_key, $value['property_id']))
        {
            echo Html::label($p_value['name'] . ' :');
            echo '<br />';
            echo Html::textInput($p_value['name']) . '<br />';
        }
    }

    echo Html::hiddenInput('entity_id', $key);
    echo Html::hiddenInput('entity_name', $value['name']);
?>

<div class="form-group">
        <div class="col-lg">
            <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>


<?php

    echo '<br /><br />';

}
?>


<?php /*$form->field($model, 'dataTypeName')
    ->textInput(['style' => 'width:300px'])
    ->hint('Name of type for data')
    ->label('Add new type for data:') 
?>

<?= $form->field($model, 'baseTypeName')
    ->dropDownList($baseDataType, ['style' => 'width:300px', 'prompt' => 'Please select base type of data'])
    ->hint('Standart system data type')
    ->label('Select standart datatype :') */
?>

</div><!-- SubjectArea -->

<div style="margin-top: 80px;">


<?php
if(!empty($data))
{

    foreach ($data as $key => $value) {
        $entityData[$value['entity_name']][] = $value;
    }

foreach ($entityData as $keyData => $valueData) {
    echo "Data for <b>$keyData</b> entity: <br />";

    echo "<table class = 'table table-striped table-bordered table-hover'";
    echo "<tr>";

    foreach ($valueData as $key => $value) {
        $head = array_keys($value);
        $dataValue[] = $value;
    }

    foreach ($head as $key => $value) {
        echo "<th>" . str_replace('_', ' ', $value) . "</th>";
    }
    
    echo "</tr>";

    foreach ($dataValue as $key => $value) {
        echo '<tr>';
        foreach ($value as $k => $v) {
            echo "<td>$v</td>";
        }
        echo '</tr>';
    }

    echo "</table>";

    unset($dataValue);
}

    echo "</tr>";
} else {
    echo "<p><b>Type of data is not exists</b></p>";
}
?>
</div>