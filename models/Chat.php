<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property string $chat_id
 * @property integer $uid
 * @property integer $doctor_id
 * @property string $ctime
 * @property string $last_time
 * @property string $last_msg
 * @property User $user
 * @property Doctor $doctor
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chat_id'], 'required'],
            [['uid', 'doctor_id'], 'integer'],
            [['ctime', 'last_time'], 'safe'],
            [['last_msg'], 'string'],
            [['chat_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chat_id' => '聊天ID',
            'uid' => '用户',
            'doctor_id' => '医生',
            'ctime' => '创建时间',
            'last_time' => '最后聊天时间',
            'last_msg' => '最后聊天内容',
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['uid' => 'doctor_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['uid' => 'uid']);
    }

    public static function getList($doctorId, $userName = '')
    {
        $query = Chat::find()
            ->where(['doctor_id' => $doctorId])
            ->orderBy(['last_time' => SORT_DESC]);
        if ($userName) {
            $query->joinWith('user')
                ->andWhere(['like', 'user.name', $userName]);
        }
        return $query->all();
    }
}
