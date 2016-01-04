<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $customerName
 * @property string $contactAddress
 * @property string $contactEmail
 * @property integer $isWork
 * @property string $comments
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerName', 'contactAddress', 'contactEmail', 'isWork', 'comments'], 'required'],
            [['isWork'], 'integer'],
            [['customerName', 'contactAddress', 'contactEmail', 'comments'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerName' => 'Customer Name',
            'contactAddress' => 'Contact Address',
            'contactEmail' => 'Contact Email',
            'isWork' => 'Is Work',
            'comments' => 'Comments',
        ];
    }


    /**
     * List all names of Customers with their id.
     * @return mixed
     */
    public function getNameList()
    {
        return static::find()
                        ->orderBy('id')
                        ->asArray()
                        ->all();
    }
}
