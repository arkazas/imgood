<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\DataSearch $searchModel
 */

$this->title = 'Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-index">
    <p>
        <?= Html::a('Create Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'entity_id',
            'property_id',
            'value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>


    <?php
if(!empty($data))
{
    $table = '';
    $head = '';
    echo "<table class = 'table table-bordered table-striped '";
    /*echo "<tr><th>Property name</th><th>Properties</th><th colspan='2' style='text-align: center' >Actions</th></tr>"*/;

    foreach($data as $key => $value)
    {
        if(empty($head)){
            $head .= "<tr>";
            $head .= '<th>ID</th>';
            foreach ($value as $k_key => $k_value) {
                $head .= '<th>' . $k_value['property_name'] . '</th>';
            }
            $head .= "<th>Actions</th>";
            $head .= "</tr>";
        }

        $table .= "<tr>";
        $table .= '<td>' . $key . '</td>';
        foreach ($value as $k_key => $k_value) {
            $table .= '<td>' . $k_value['value'] . '</td>';
        }
        $table .= "<td>" . Html::a('Edit', ['data/update', 'id' => $key], ['class' => 'btn btn-info btn-xs']);
        $table .=  Html::a('Delete', ['data/remove', 'id' => $key], 
            ['class' => 'btn btn-danger btn-xs', 'onClick' => 'return confirm("Do you want remove this item?") ? true : false;']) . "</td>";
        $table .= "</tr>";

        /*echo "<tr><td width='44%'>";
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
        echo "</td></tr>";*/
    }

    echo $head . $table;

    echo "</table>";
} else {
    echo "<p><b>Data is not exists</b></p>";
}
?>

</div>
