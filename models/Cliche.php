<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliche".
 *
 * @property integer $id
 * @property integer $customerId
 * @property string $clicheName
 * @property integer $clicheCutting
 * @property integer $colorNumbers
 * @property integer $isWork
 * @property string $comments
 */
class Cliche extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliche';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'clicheCutting', 'colorNumbers', 'isWork'], 'integer'],
            [['clicheName', 'comments'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerId' => 'Customer ID',
            'clicheName' => 'Cliche Name',
            'clicheCutting' => 'Cliche Cutting',
            'colorNumbers' => 'Color Numbers',
            'isWork' => 'Is Work',
            'comments' => 'Comments',
        ];
    }
}
