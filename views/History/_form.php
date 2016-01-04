<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\History */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'objectId')->textInput() ?>

    <?= $form->field($model, 'tableName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actionName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actionDate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actionComment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
