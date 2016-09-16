<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 * @property string $ctime
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['ctime'], 'safe'],
            [['id'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 200],
            [['value'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '关键字',
            'name' => '名字',
            'value' => '取值',
            'ctime' => '创建时间',
        ];
    }
}
