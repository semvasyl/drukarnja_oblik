<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cliches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliche-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cliche', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customerId',
            'clicheName',
            'clicheCutting',
            'colorNumbers',
            // 'isWork',
            // 'comments',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
