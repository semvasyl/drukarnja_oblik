<?php
/**
 * Yii2DbRbac for Yii2
 *
 * @author Elle <elleuz@gmail.com>
 * @version 0.1
 * @package Yii2DbRbac for Yii2
 *
 */
//namespace developeruz\db_rbac;
namespace app\modules\developeruz\Yii2DbRbac;

use Yii;

class Yii2DbRbac extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\developeruz\Yii2DbRbac\controllers';
    public $userClass;

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['db_rbac'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-Ru',
            'basePath' => '@app/modules/developeruz/Yii2DbRbac/messages',
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/developeruz/Yii2DbRbac/' . $category, $message, $params, $language);
    }
}
