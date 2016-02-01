<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $orderId
 * @property integer $pressure
 * @property integer $orderDate
 * @property integer $bugalterId
 * @property integer $customerId
 * @property integer $managerId
 * @property integer $typographerId
 * @property integer $dateCreated
 * @property integer $dateStartJob
 * @property integer $dateEndJob
 * @property string $orderStatus
 * @property string $orderComment
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pressure', 'orderDate', 'bugalterId','customerId', 'managerId', 'typographerId', 'dateCreated', 'dateStartJob', 'dateEndJob', 'orderStatus', 'orderComment'], 'required'],
            [['pressure', 'orderDate', 'bugalterId','customerId', 'managerId', 'typographerId', 'dateCreated', 'dateStartJob', 'dateEndJob'], 'integer'],
            [['orderStatus', 'orderComment'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderId' => 'Order ID',
            'pressure' => 'Pressure',
            'orderDate' => 'Order Date',
            'bugalterId' => 'Bugalter ID',
            'customerId' => 'Customer ID',
            'managerId' => 'Manager ID',
            'typographerId' => 'Typographer ID',
            'dateCreated' => 'Date Created',
            'dateStartJob' => 'Date Start Job',
            'dateEndJob' => 'Date End Job',
            'orderStatus' => 'Order Status',
            'orderComment' => 'Order Comment',
        ];
    }
}
