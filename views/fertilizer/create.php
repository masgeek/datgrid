<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvailableFertilizer */

$this->title = 'Create Available Fertilizer';
$this->params['breadcrumbs'][] = ['label' => 'Available Fertilizers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="available-fertilizer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
