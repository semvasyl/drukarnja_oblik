<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "orderDetail".
 *
 * @property integer $id
 * @property integer $orderId
 * @property string $materialName
 * @property string $materialDescription
 * @property string $amount
 * @property string $amontActual
 * @property string $amountMeters
 * @property string $amountMetersEstimated
 * @property string $clisheName
 * @property integer $clisheCutting
 * @property string $colorNumbers
 * @property integer $position
 * @property integer $dateStart
 * @property integer $dateFinish
 * @property string $comment
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderDetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'materialName', 'materialDescription', 'amount', 'amontActual', 'amountMeters', 'amountMetersEstimated', 'clisheName', 'clisheCutting', 'colorNumbers', 'dateStart', 'dateFinish', 'comment'], 'required'],
            [['orderId', 'clisheCutting', 'position', 'dateStart', 'dateFinish'], 'integer'],
            [['amount', 'amontActual', 'amountMeters', 'amountMetersEstimated'], 'number'],
            [['materialName', 'materialDescription', 'clisheName', 'colorNumbers', 'comment'], 'string', 'max' => 254]
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
            'amount' => 'Amount',
            'amontActual' => 'Amont Actual',
            'amountMeters' => 'Amount Meters',
            'amountMetersEstimated' => 'Amount Meters Estimated',
            'clisheName' => 'Clishe Name',
            'clisheCutting' => 'Clishe Cutting',
            'colorNumbers' => 'Color Numbers',
            'position' => 'Position',
            'dateStart' => 'Date Start',
            'dateFinish' => 'Date Finish',
            'comment' => 'Comment',
        ];
    }

    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

}
