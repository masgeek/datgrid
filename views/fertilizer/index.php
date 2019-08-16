<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Available Fertilizers';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'name',
        'editableOptions' => [
            'asPopover' => false,
            'formOptions' => ['action' => ['edit-fertilizer']]
        ]
    ],
//    'name',
    'type',
    'n_content',
    'p_content',
    //'k_content',
    //'weight',
    //'price',
    //'country',
    //'available:boolean',
    //'custom:boolean',
    //'created_at',
    //'updated_at',

    ['class' => 'yii\grid\ActionColumn'],
];
?>
<div class="available-fertilizer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Available Fertilizer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); ?>


</div>
