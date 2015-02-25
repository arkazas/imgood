<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$packages = $model->getPackages();
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'firstName',
            'lastName',
            'email:email',
            [
                'attribute' => 'registrationDate',
                'format' => ["date", "php:d.m.Y"],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'registrationDate',
                    'options' => [
                        'class' => 'form-control'
                    ],
                    'clientOptions' => [
                        'dateFormat' => 'd.m.Y',
                    ],
                ]),

            ],
            [
                'attribute' => 'lastLogin',
                'format' => ["date", "php:d.m.Y"],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'lastLogin',
                    'options' => [
                        'class' => 'form-control'
                    ],
                    'clientOptions' => [
                        'dateFormat' => 'd.m.Y',
                    ]
                ]),
            ],
            [
                'attribute' => 'package_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'package_id',
                    $packages,
                    ['class' => 'form-control']
                ),
                'value' => function($model) use ($packages){
                    return $packages[$model->package_id];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{active} {update} {delete}',
                'buttons' => [
                    'active' => function ($url, $model, $key) {
                        $class = $model->isActive ? 'glyphicon-ok green' : 'glyphicon-remove red';

                        return '<span class="glyphicon ' . $class . '"></span>';
                    }
                ],
            ],
        ],
    ]); ?>

</div>
