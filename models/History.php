<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $objectId
 * @property string $tableName
 * @property string $actionName
 * @property string $actionDate
 * @property string $actionComment
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'objectId'], 'integer'],
            [['tableName', 'actionName', 'actionDate', 'actionComment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'objectId' => 'Object ID',
            'tableName' => 'Table Name',
            'actionName' => 'Action Name',
            'actionDate' => 'Action Date',
            'actionComment' => 'Action Comment',
        ];
    }
}
