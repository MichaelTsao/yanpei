<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fav".
 *
 * @property integer $uid
 * @property integer $doctor_id
 */
class Fav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户',
            'doctor_id' => '医师',
        ];
    }

    public static function getCount($uid)
    {
        return self::find()->where(['doctor_id' => $uid])->count();
    }
}
