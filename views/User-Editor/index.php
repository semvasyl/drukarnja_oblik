<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Користувачі системи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати користувача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'header' => 'Код',
                'attribute' => 'id',
                //'format' => ['decimal', 2],
            ],
            [
                'label' => 'Користувач',
                'attribute' => 'username',
                //'format' => ['decimal', 2],
            ],
            [
                'label' => 'Посада',
                'attribute' => 'positionWork',

                
                //'format' => ['decimal', 2],
            ],
            [
                'label' => 'Опис',
                'attribute' => 'comments',
                //'format' => ['decimal', 2],
            ],
            [
                'label' => 'Статус',
                'attribute' => 'isWork',
                //'format' => ['decimal', 2],
            ],
            //'username',
            //'password',
            //'authKey',
            //'accessToken',
            //'positionWork',
            //'comments',
            //'isWork',
            // 'levelAccess',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
