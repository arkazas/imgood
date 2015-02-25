<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="SubjectArea">
    <?php /*Html::beginForm(Html::url(['subject-area/add'])); ?>
        <h3><?= Html::tag('b', 'Subject areas'); ?></h3>
        <br /><br />

        <?= Html::label('Add new subject area:'); ?>
        <br />
        <?= Html::input('text', 'subjectAreaName', '', ['size' => '40']); ?>

        <div class="form-group" style="margin-top: 15px;">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    <?= Html::endForm(); */ ?>



<?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['class' => 'form-horizontal'],
        'action' => Html::url(['subject-area/add']),
    ]);?>

<?= $form->field($model, 'subjectAreaName')
    ->textInput(['style' => 'width:400px'])
    ->hint('Input subject area name')
    ->label('Add subject area:') 
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
if(!empty($areas))
{
    echo "<table class = 'table table-bordered table-striped '";
    echo "<tr><th>Subject Area name</th><th colspan='2' style='text-align: center' >Actions</th></tr>";

    foreach($areas as $key => $value)
    {
        echo "<tr><td width='88%'>";
            echo $value['name'];
        echo "</td><td width='6%'>";
        echo Html::a('Edit', Html::url(['subject-area/edit', 'id' => $key]), ['class' => 'btn btn-info']);
        echo "</td><td width='6%'>";
        echo Html::a('Delete', Html::url(['subject-area/remove', 'id' => $key]), 
            ['class' => 'btn btn-danger', 'onClick' => 'return confirm("Do you want remove this item?") ? true : false;']);
        echo "</td></tr>";
    }

    echo "</table>";
} else {
    echo "<p><b>Subject areas is not exists</b></p>";
}
?>
</div>