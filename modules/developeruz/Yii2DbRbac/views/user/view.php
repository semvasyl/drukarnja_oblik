<?php
//namespace developeruz\db_rbac\views\user;
namespace app\modules\developeruz\Yii2DbRbac\views\user;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h3><?=Yii::t('db_rbac', 'Управление ролями пользователя');?> <?= $user->getUserName(); ?></h3>
<?php $form = ActiveForm::begin(['action' => ["/{$moduleName}/user/update", 'id' => $user->getId()]]); ?>

<?= Html::checkboxList('roles', $user_permit, $roles, ['separator' => '<br>']); ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('db_rbac', 'Сохранить'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

