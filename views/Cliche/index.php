<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кліше';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliche-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити кліше', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'header' => 'Замовник',
                'attribute' => 'customerId',
            ],
            [
                'header' => 'Назва кліше',
                'attribute' => 'clicheName',
            ],
            [
                'header' => 'Форма висічки',
                'attribute' => 'clicheCutting',
            ],
            [
                'header' => 'Використовується',
                'attribute' => 'isWork',
            ],
            //'id',
            /*'customerId',
            'clicheName',
            'clicheCutting',
            'colorNumbers',*/
            // 'isWork',
            // 'comments',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
