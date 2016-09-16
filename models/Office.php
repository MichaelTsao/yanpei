<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "office".
 *
 * @property integer $office_id
 * @property string $name
 * @property integer $hospital_id
 */
class Office extends \yii\db\ActiveRecord
{
    public static $time_section = [
        1 => '9:00 - 11:00',
        2 => '11:00 - 13:00',
        3 => '13:00 - 15:00',
        4 => '15:00 - 17:00',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'office';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospital_id'], 'integer'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'office_id' => '验配室ID',
            'name' => '名字',
            'hospital_id' => '验配中心',
        ];
    }
}
