<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orderDetailPressure".
 *
 * @property integer $id
 * @property integer $orderId
 * @property integer $materialName
 * @property integer $materialDescription
 * @property integer $amontMeters
 * @property integer $pressureForm
 */
class OrderDetailPressure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderDetailPressure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'materialName', 'materialDescription', 'amontMeters', 'pressureForm'], 'required'],
            [['orderId', 'materialName', 'materialDescription', 'amontMeters', 'pressureForm'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'materialName' => 'Material Name',
            'materialDescription' => 'Material Description',
            'amontMeters' => 'Amont Meters',
            'pressureForm' => 'Pressure Form',
        ];
    }
}
