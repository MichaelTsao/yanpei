<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $id
 * @property integer $hospital_id
 * @property integer $product_id
 * @property integer $amount
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospital_id', 'product_id', 'amount'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_id' => '验配中心',
            'product_id' => '产品',
            'amount' => '库存',
        ];
    }
}
