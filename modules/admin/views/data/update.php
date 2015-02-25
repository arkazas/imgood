<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm; 

/**
 * @var yii\web\View $this
 * @var app\models\Data $model
 */

$this->title = 'Update Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-update">

	<?php $form = ActiveForm::begin(); ?>

<?php foreach ($data as $key => $value) {

//var_dump($data);die;

	if(empty($id))
		$id = $value['id'];

	echo Html::label($value['property_name'] . '  :');
	echo Html::input('text', $value['property_id'], $value['value']) . '<br />';
}

//echo Html::hiddenInput('id', $id);

?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Update' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>