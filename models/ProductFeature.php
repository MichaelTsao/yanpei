<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_feature".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $feature_id
 * @property integer $sort
 */
class ProductFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'feature_id'], 'required'],
            [['product_id', 'feature_id', 'sort'], 'integer'],
            [['product_id', 'feature_id'], 'unique', 'targetAttribute' => ['product_id', 'feature_id'], 'message' => 'The combination of 产品 and 特点 has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => '产品',
            'feature_id' => '特点',
            'sort' => '排序',
        ];
    }
}
