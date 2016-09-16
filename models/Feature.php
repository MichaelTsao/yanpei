<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feature".
 *
 * @property integer $feature_id
 * @property string $name
 * @property integer $type
 */
class Feature extends \yii\db\ActiveRecord
{
    const TYPE_COMMON = 1;
    const TYPE_SCOPE = 2;
    public static $types = [
        self::TYPE_COMMON => '常规',
        self::TYPE_SCOPE => '验配范围',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feature_id' => 'Feature ID',
            'name' => '名称',
            'type' => '类型',
        ];
    }

    public static function getList($type)
    {
        $r = [];
        $data = self::findAll(['type' => $type]);
        foreach ($data as $item) {
            $r[$item->feature_id] = $item->name;
        }
        return $r;
    }
}
