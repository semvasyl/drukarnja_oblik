<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Cliche */
/* @var $form yii\widgets\ActiveForm */
?>




<div class="cliche-form">

    <?php $form = ActiveForm::begin(); ?>

    


    <?= $form->field($model, 'customerId')->widget(Select2::classname(), [
        'attribute' => 'color',
        'data' => $customers_base,
        'options' => ['placeholder' => 'Select'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ->label('Замовник'); ?>


    <?= $form->field($model, 'clicheName')->textInput(['maxlength' => true])->label('Назва кліше'); ?>

    <?= $form->field($model, 'clicheCutting')->textInput()->label('Форма висічки кліше') ?>

    <?= $form->field($model, 'colorNumbers')->textInput()->label('Кількість кольорів') ?>

    <?= $form->field($model, 'isWork')->dropDownList([1 => 'Так', 0 => 'Ні'])->label('Використовується') ?>
    
    <?= $form->field($model, 'comments')->textInput(['maxlength' => true])->label('Примітки') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
