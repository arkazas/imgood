<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'lastName')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'isActive')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'isConfirm')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'registrationDate')->textInput() ?>

    <?= $form->field($model, 'lastLogin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
