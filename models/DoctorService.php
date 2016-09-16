<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctor_service".
 *
 * @property integer $uid
 * @property integer $service_id
 */
class DoctorService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'service_id'], 'required'],
            [['uid', 'service_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'service_id' => 'Service ID',
        ];
    }
}
