<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cliche */

$this->title = 'Створити кліше';
$this->params['breadcrumbs'][] = ['label' => 'Кліше', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliche-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'customers_model' => $customers_model,
        'customers_base' => $customers_base,
    ]) ?>

</div>
