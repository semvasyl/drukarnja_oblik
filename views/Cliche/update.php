<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliche */

$this->title = 'Редагувати кліше: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Кліше', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="cliche-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'customers_model' => $customers_model,
        'customers_base' => $customers_base,
    ]) ?>

</div>
