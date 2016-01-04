<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Логін') ?>

    <?= $form->field($model, 'displayName')->textInput(['maxlength' => true])->hint('Будь-ласка введіть імя')->label('Показувати ім\'я') ?>

    <div class="form-group">
        
            <?= Html::label("Пароль","",['class' => 'control-label'])?>
            <?= Html::textInput("newPassword","",['maxlength' => 255, 'class' => 'form-control'])?>
        
    </div>
    <?= Html::hiddenInput("password",$model->password)?>
    <?= Html::hiddenInput("authKey",$model->authKey)?>
    <?= Html::hiddenInput("accessToken",$model->accessToken)?>
    <?= Html::hiddenInput("levelAccess",$model->levelAccess)?>
    

    <?= $form->field($model, 'positionWork')->textInput(['maxlength' => true])->label('Посада') ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true])->label('Примітка') ?>

    <?= $form->field($model, 'isWork')->dropDownList([1 => 'Так', 0 => 'Ні'])->label('Працівник працює?') ?>

    



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
