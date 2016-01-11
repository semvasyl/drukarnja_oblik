<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customerName')->textInput(['maxlength' => true])->label('Назва'); ?>

    <?= $form->field($model, 'contactAddress')->textInput(['maxlength' => true])->label('контактна адреса'); ?>

    <?= $form->field($model, 'contactEmail')->textInput(['maxlength' => true])->label('е-пошта'); ?>

    <?= $form->field($model, 'isWork')->dropDownList([1 => 'Так', 0 => 'Ні'])->label('Відбувається співпраця') ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true])->label('Примітка') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
