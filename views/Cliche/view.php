<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliche */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Кліше', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliche-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити запис?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [                      
                'label' => 'Код',
                'value' => $model->id,
            ],   
            [                      
                'label' => 'Замовник',
                'value' => $model->customerId."  (".$selectedCustomer.")",
            ],
            [                      
                'label' => 'Назва кліше',
                'value' => $model->clicheName,
            ],  
            [                      
                'label' => 'Форма висічки',
                'value' => $model->clicheCutting,
            ],
            [                      
                'label' => 'Кількість кольорів',
                'value' => $model->colorNumbers,
            ],
            [                      
                'label' => 'Використовується',
                'value' => $model->isWork,
            ],
            [                      
                'label' => 'Примітки',
                'value' => $model->comments,
            ],       
            
        ],
    ]) ?>

</div>
