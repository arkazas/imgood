<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">

<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['language/add']),
    ]);?>

<?= $form->field($model, 'languageName')
    ->textInput(['style' => 'width:400px'])
    ->hint('Input language name')
    ->label('Add new language:') 
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
    echo "<tr><th>Language name</th><th colspan='2' style='text-align: center' >Actions</th></tr>";

    foreach($data as $key => $value)
    {
        echo "<tr><td width='88%'>";
            echo $value['name'];
        echo "</td><td width='6%'>";
        echo Html::a('Edit', Html::url(['language/edit', 'id' => $key]), ['class' => 'btn btn-info']);
        echo "</td><td width='6%'>";
        echo Html::a('Delete', Html::url(['language/remove', 'id' => $key]), 
            ['class' => 'btn btn-danger', 'onClick' => 'return confirm("Do you want remove this item?") ? true : false;']);
        echo "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p><b>Languages is not exists</b></p>";
}
?>
</div>