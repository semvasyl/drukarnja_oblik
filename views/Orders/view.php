<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->orderId;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення на друк', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['Змінити', 'id' => $model->orderId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['Видалити', 'id' => $model->orderId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно бажаєте видалити позицію?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'orderId',
            'pressure',
            'orderDate',
            'customerId',
            'managerId',
            'typographerId',
            'dateCreated',
            'dateStartJob',
            'dateEndJob',
            'orderStatus',
            'orderComment',
        ],
    ]) ?>

</div>
