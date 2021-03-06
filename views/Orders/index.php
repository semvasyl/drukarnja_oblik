<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення на друк';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити замовлення', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'orderId',
            //'pressure',
            [
                'label' => 'Замовлення від',
                'attribute' => 'orderDate',
            ],
            [
                'label' => 'Замовник',
                'attribute' => 'customerId',
            ],
            [
                'label' => 'Статус заявки',
                'attribute' => 'orderStatus',
            ],
            // 'orderDate',
            // 'customerId',
            // 'managerId',
            // 'typographerId',
            // 'dateCreated',
            // 'dateStartJob',
            // 'dateEndJob',
            // 'orderStatus',
            // 'orderComment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
