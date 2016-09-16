<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ill".
 *
 * @property integer $ill_id
 * @property string $name
 * @property integer $type
 */
class Ill extends \yii\db\ActiveRecord
{
    const TYPE_ILL = 1;
    const TYPE_TOXIC = 2;
    public static $types = [
        self::TYPE_ILL => '疾病',
        self::TYPE_TOXIC => '中毒药物',
    ];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ill_id' => '疾病ID',
            'name' => '名字',
            'type' => '类型',
        ];
    }

    public static function getList($type = null)
    {
        $d = self::find();
        if ($type) {
            $d->where(['type' => $type]);
        }
        $data = $d->orderBy(['name' => SORT_ASC])->all();
        $r = [];
        foreach ($data as $item) {
            $r[$item->ill_id] = $item->name;
        }
        return $r;
    }
}
