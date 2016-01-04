<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cliche */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliche-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customerId')->textInput() ?>


    

    <?= $form->field($model, 'clicheName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clicheCutting')->textInput() ?>

    <?= $form->field($model, 'colorNumbers')->textInput() ?>

    <?= $form->field($model, 'isWork')->textInput() ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
