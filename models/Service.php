<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $service_id
 * @property string $name
 * @property integer $price
 * @property integer $status
 */
class Service extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSED = 0;
    public static $status_list = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_CLOSED => '关闭',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'status'], 'integer'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => 'Service ID',
            'name' => '名字',
            'price' => '价格',
            'status' => '状态',
        ];
    }

    public static function getList()
    {
        return ['0' => '全部'] + self::find()
            ->select(['name'])
            ->where(['status' => self::STATUS_ACTIVE])
            ->indexBy('service_id')->asArray()->column();
    }
}
