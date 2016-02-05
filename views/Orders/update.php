<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Змінити дані щодо замовлення: ' . ' ' . $model->orderId;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->orderId, 'url' => ['view', 'id' => $model->orderId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $modelOrder,
        'customers_base' => $customers_base,
        'modelItems' => $modelsItems
    ]) ?>

</div>
