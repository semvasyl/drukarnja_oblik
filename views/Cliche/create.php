<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cliche */

$this->title = 'Create Cliche';
$this->params['breadcrumbs'][] = ['label' => 'Cliches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliche-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
