<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\BaseHtml;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
    
    $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
        console.log("beforeInsert");
    });

    $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        console.log("afterInsert");
    });

    $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
        if (! confirm("Are you sure you want to delete this item?")) {
            return false;
        }
        return true;
    });

    $(".dynamicform_wrapper").on("afterDelete", function(e) {
        console.log("Deleted item!");
    });

    $(".dynamicform_wrapper").on("limitReached", function(e, item) {
        alert("Limit reached");
    });
JS;
//$this->registerJs($script,  yii\web\View::POS_READY);

?>

<div class="order-form">


    <?php $form = ActiveForm::begin(['id' => 'ISSUEform']); ?>

    <?= $form->field($model, 'pressure')->hiddenInput(['value' => (!empty($model->pressure)?$model->pressure:0)])->label(false) ?>

    <?= $form->field($model, 'orderDate')->textInput(['value' => (!empty($model->orderDate)?$model->orderDate:date("d.m.Y"))])->label('Замовлення від') ?>


    <?= $form->field($model, 'customerId')->widget(Select2::classname(), [
        'attribute' => 'color',
        'data' => $customers_base,
        'options' => ['placeholder' => 'Select'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ->label('Замовник'); ?>

    <?= $form->field($model, 'managerId')->hiddenInput(['value' => (!empty($model->managerId)?$model->managerId:Yii::$app->user->identity->levelAccess)])->label(false) ?>



    <?= $form->field($model, 'dateCreated')->hiddenInput(['value' => (!empty($model->dateCreated)?$model->dateCreated:time())])->label(false) ?>

    <?= $form->field($model, 'dateStartJob')->hiddenInput(['value' => (!empty($model->dateStartJob)?$model->dateStartJob:time())])->label(false) ?>

   

    
    <? 
    /*$form->field($model, 'orderStatus')->hiddenInput(['maxlength' => true])->label(false) 
    $form->field($model, 'typographerId')->hiddenInput(['value' => $model->typographerId])->label(false)
    $form->field($model, 'dateEndJob')->hiddenInput(['value' => $model->dateEndJob])->label(false)*/
    ?>

    <div class="form-group">
    
    <label class="control-label" for="order-orderdate">Статус : <?= Yii::$app->user->identity->id ?></label>
        <label class="control-label" for="order-orderdate"><br/>Статус замовлення: <?= $model->orderStatus ?></label>
    </div>


    <?= $form->field($model, 'orderComment')->textInput(['maxlength' => true])->label('Примітка') ?>




 <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be added (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelItems[0],
        'formId' => 'ISSUEform',//ISSUEform | dynamic-form
        'formFields' => [
            'materialName',
            'materialDescription',
            'amount',
            'amontActual',
            'amountMeters',
            'amountMetersEstimated',
            'clisheName',
            'clisheCutting',
            'colorNumbers',
            'position',
            'dateStart',
            'dateFinish',
            'comment',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-th-list"></i> Позиції
                <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items"><!-- widgetBody -->
            <?php foreach ($modelItems as $i => $modelItem): ?>
                <div class="item panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">№</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelItem, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelItem, "[{$i}]materialName")->textInput(['maxlength' => true])->label('Назва матеріалу') ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelItem, "[{$i}]materialDescription")->textInput(['maxlength' => true])->label('Опис матеріалу') ?>
                            </div>

                        </div><!-- .row -->     

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]amount")->textInput(['maxlength' => true])->label('Кількість') ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]amontActual")->textInput(['maxlength' => true])->label('Фактична кількість') ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]amountMeters")->textInput(['maxlength' => true])->label('Орієнтовна кількість (м. погонні)') ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]amountMetersEstimated")->textInput(['maxlength' => true])->label('Фактична кількість (м. погонні)') ?>
                            </div>
                        </div><!-- .row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]clisheName")->textInput(['maxlength' => true, 'value' => "Святкова"])->label('Назва кліше') ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]clisheCutting")->textInput(['maxlength' => true, 'value' =>88])->label('Форма висічки') ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]colorNumbers")->textInput(['maxlength' => true, 'value' => "3 (M Y p.Br)"])->label('Кількість кольорів') ?>
                            </div>
                        </div><!-- .row -->   

                        <?= $form->field($model, '[{$i}]position')->hiddenInput(['value' => 1])->label(false) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]dateStart")->textInput(['maxlength' => true, 'value' => time()])->label('Видано на друк') ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]dateFinish")->textInput(['maxlength' => true, 'value' => time()])->label('Виконано друк') ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelItem, "[{$i}]comment")->textInput(['maxlength' => true])->label('Примітка') ?>
                            </div>
                        </div><!-- .row -->                                              

                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>







    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
