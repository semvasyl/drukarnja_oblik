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
            
            [['pressure', 'orderDate','customerId', 'managerId','dateCreated', 'dateStartJob'], 'required','on' => 'managerAdd'],
            [['orderStatus', 'bugalterId'], 'required','on' => 'bugalterConfirm'],
            [['pressure', 'orderDate','customerId', 'managerId','dateCreated', 'bugalterId', 'typographerId', 'dateStartJob', 'dateEndJob'], 'required','on' => 'typographerConfirm'],

            [['pressure', 'bugalterId','customerId', 'managerId', 'typographerId', 'dateCreated', 'dateStartJob', 'dateEndJob'], 'integer'],
            [['orderStatus', 'orderDate', 'orderComment'], 'string', 'max' => 254]
        ];
    }
    //[['pressure', 'orderDate', 'bugalterId','customerId', 'managerId', 'typographerId', 'dateCreated', 'dateStartJob', 'dateEndJob', 'orderStatus', 'orderComment'], 'required'],


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'managerAdd' => ['pressure', 'orderDate','customerId', 'managerId','dateCreated', 'orderStatus', 'orderComment'],
            'bugalterConfirm' => ['orderStatus', 'bugalterId'],
            'typographerConfirm' => ['pressure', 'orderDate', 'bugalterId','customerId', 'managerId', 'typographerId', 'dateCreated', 'dateStartJob', 'dateEndJob', 'orderStatus', 'orderComment'],
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
