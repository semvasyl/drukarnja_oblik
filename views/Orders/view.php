<?php

use yii\helpers\Html;
// use yii\widgets\DetailView;
use kartik\detail\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->orderId;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення на друк', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <?= Html::a('Редагувати', ['update', 'id' => $model->orderId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->orderId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно бажаєте видалити позицію?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php 

echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Замовлення від ' . $model->orderDate,
        'type'=>DetailView::TYPE_INFO,
    ],

    'attributes'=>[
        /*[
            'columns'=>[

                
            ],
        ],*/

        [
            'attribute'=>'orderDate', 
            'label' => 'Замовлення від',
            'type'=>DetailView::INPUT_DATE
        ],
        
        [
            'attribute'=>'customerId', 
            'label' => 'Замовник',
            'type'=>DetailView::INPUT_TEXT,
            'value' => $customer,
            'valueColOptions'=>['style'=>'width:30%']
        ],

        [
            'attribute'=>'pressure', 
            'label' => 'Тиснення',
            'type'=>DetailView::INPUT_SWITCH,        
            'format'=>'raw',
            'value'=>$model->pressure ? '<span class="label label-default">Є тиснення</span>' : '<span class="label label-default">Немає тиснення</span>',
            'valueColOptions'=>['style'=>'width:30%']
        ],
        
        [
            'group'=>true,
            'label'=>'Відповідальні особи',
            'rowOptions'=>['class'=>'info'],
            //'groupOptions'=>['class'=>'text-center']
        ],        
        
        [
            'attribute'=>'managerId', 
            'label' => 'Замовлення прийняв',
            'type'=>DetailView::INPUT_SELECT2,
            'value'=>$manager,
        ],
        [
            'attribute'=>'bugalterId', 
            'label' => 'Підтвердив бухгалтер',
            'type'=>DetailView::INPUT_SELECT2
        ],
        [
            'attribute'=>'typographerId', 
            'label' => 'Друкар, який виконує',
            'type'=>DetailView::INPUT_SELECT2
        ],

        [
            'group'=>true,
            'label'=>'Терміни',
            'rowOptions'=>['class'=>'info'],
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'attribute'=>'dateCreated', 
            'label' => 'Створено заявку',
            'type'=>DetailView::INPUT_DATE,
            'value'=>date("d.m.Y",$model->dateCreated),
        ],
        [
            'attribute'=>'dateStartJob', 
            'label' => 'Розпочато роботу',
            'type'=>DetailView::INPUT_DATE,
            'visible'=>((!$model->dateStartJob==0)?true:false)

        ],
        [
            'attribute'=>'dateEndJob', 
            'label' => 'Завершено роботу',
            'type'=>DetailView::INPUT_DATE,
            'visible'=>((!$model->dateEndJob==0)?true:false)
        ],
        [
            'group'=>true,
            'label'=>'Додаткова інформація',
            'rowOptions'=>['class'=>'info'],
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'attribute'=>'orderStatus', 
            'label' => 'Статус',
            'type'=>DetailView::INPUT_TEXT
        ],
        [
            'attribute'=>'orderComment', 
            'label' => 'Примітка',
            'type'=>DetailView::INPUT_TEXT,
            'visible'=>((strlen($model->orderComment)>1)?true:false)
        ],
        

    ]
    ]);


            echo GridView::widget([
                'dataProvider' => $modelItemsProvider, 
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered'
                ],                       
                'columns'=>[
                            
                    [
                        'attribute'=>'materialName',
                        'label'=>'Матеріал',
                        'value'=>function($data){
                            return $data->materialName."\n".$data->materialDescription;
                        }
                    ],

                    [
                        'attribute'=>'materialDescription',
                        'label'=>'Опис',
                        'visible' => false
                    ],

                    [
                        'attribute'=>'amount',
                        'label'=>'К-сть',
                    ],

                    [
                        'attribute'=>'amontActual',
                        'label'=>'Фактич. к-сть',
                    ],

                    [
                        'attribute'=>'amountMeters',
                        'label'=>'Орієнт. к-сть',
                    ],

                    [
                        'attribute'=>'amountMetersEstimated',
                        'label'=>'Фактична к-сть (м. погонні)',
                    ],

                    [
                        'attribute'=>'clisheName',
                        'label'=>'Назва кліше',
                    ],

                    [
                        'attribute'=>'clisheCutting',
                        'label'=>'Форма висічки',
                    ],

                    [
                        'attribute'=>'colorNumbers',
                        'label'=>'К-сть кольорів',
                    ],

                    [
                        'attribute'=>'position',
                        'label'=>'позиція',
                        'visible' => false
                    ],

                    [
                        'attribute'=>'dateStart',
                        'label'=>'Видано на друк',
                        'value'=>function($data){
                            return date("d.m.Y",$data->dateStart);
                        }
                    ],

                    [
                        'attribute'=>'dateFinish',
                        'label'=>'Виконано друк',
                        'value'=>function($data){
                            return date("d.m.Y",$data->dateFinish);
                        }
                    ],

                    [
                        'attribute'=>'comment',
                        'label'=>'Примітка',
                    ],
            
                ],
           
            ]);


    ?>

</div>
