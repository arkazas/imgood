<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Data $model
 */

$this->title = 'Create Data';
$this->params['breadcrumbs'][] = ['label' => 'Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-create">

	<?php $form = ActiveForm::begin(); ?>

<?php foreach ($model->properties_list as $key => $value) {

	echo Html::label($value . '  :');
	echo Html::input('text', $key, 'empty') . '<br />';
}
?>

    <?php /*$form->field($model, 'entity_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'property_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => 255]) */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
