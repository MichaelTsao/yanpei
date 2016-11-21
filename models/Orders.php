<?php

namespace app\models;

use app\models\base\DeviceUser;
use app\models\base\WeiXinSDK;
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $doctor_id
 * @property integer $uid
 * @property integer $service_id
 * @property integer $product_id
 * @property integer $hospital_id
 * @property integer $office_id
 * @property integer $time_section
 * @property string $appoint_date
 * @property integer $status
 * @property string $ctime
 * @property string $accept_time
 * @property string $pay_time
 * @property string $close_time
 * @property array $service
 * @property integer $price
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_USER_CONFIRM = 2;
    const STATUS_USER_PAY = 3;
    const STATUS_FINISH = 4;
    const STATUS_CANCEL = 5;
    public static $statusList = [
        self::STATUS_NEW => '新建',
        self::STATUS_USER_CONFIRM => '用户已接单',
        self::STATUS_USER_PAY => '用户已支付',
        self::STATUS_FINISH => '完成',
        self::STATUS_CANCEL => '取消',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_id', 'uid', 'product_id', 'hospital_id', 'office_id', 'time_section', 'status'], 'integer'],
            [['appoint_date', 'ctime', 'accept_time', 'pay_time', 'close_time', 'service_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => '订单ID',
            'doctor_id' => '验配师',
            'doctorName' => '验配师',
            'uid' => '用户',
            'userName' => '用户',
            'service_id' => '服务',
            'serviceName' => '服务',
            'product_id' => '产品',
            'productName' => '产品',
            'hospital_id' => '医院',
            'hospitalName' => '医院',
            'office_id' => '房间',
            'officeName' => '房间',
            'time_section' => '时间段',
            'sectionName' => '时间段',
            'appoint_date' => '预约时间',
            'status' => '状态',
            'statusName' => '状态',
            'ctime' => '创建时间',
            'accept_time' => '接受时间',
            'pay_time' => '支付时间',
            'close_time' => '完成时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['uid' => 'uid']);
    }

    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['uid' => 'doctor_id']);
    }

    public function getService()
    {
        return Service::findAll(['service_id' => json_decode($this->service_id, true)]);
    }

    public function getProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'order_id']);
    }

    public function getHospital()
    {
        return $this->hasOne(Hospital::className(), ['hospital_id' => 'hospital_id']);
    }

    public function getOffice()
    {
        return $this->hasOne(Office::className(), ['office_id' => 'office_id']);
    }

    public function getStatusName()
    {
        return self::$statusList[$this->status];
    }

    public static function getCount($uid)
    {
        return self::find()->where(['doctor_id' => $uid])->count();
    }

    public function getPrice()
    {
        $price = 0;
        foreach ($this->service as $s) {
            $price += $s->price;
        }
        foreach ($this->products as $prod) {
            $price += $prod->product->price;
        }
        return $price;
    }

    public function push()
    {
        $uid = 0;
        $words = '';
        switch ($this->status) {
            case self::STATUS_NEW:
                $uid = $this->uid;
                if ($this->isNewRecord) {
                    $action = '建立';
                } else {
                    $action = '修改';
                }
                $words = $this->doctorName . ' 为您' . $action . '了一个订单';
                break;
            case self::STATUS_USER_CONFIRM:
                $uid = $this->doctor_id;
                $words = $this->userName . ' 确认了订单';
                break;
            case self::STATUS_USER_PAY:
                $uid = $this->doctor_id;
                $words = $this->userName . ' 已经为订单付款';
                break;
            case self::STATUS_FINISH:
                $uid = $this->doctor_id;
                $words = $this->userName . ' 已完成订单';
                break;
            case self::STATUS_CANCEL:
                $uid = $this->doctor_id;
                $words = $this->userName . ' 已取消订单';
                break;
        }
        if ($device = DeviceUser::findOne(['uid' => $uid, 'type' => DeviceUser::TYPE_H5])) {
            $weixin = new WeiXinSDK([
                'appId' => Yii::$app->params['weixin_id'],
                'appSecret' => Yii::$app->params['weixin_key'],
            ]);
            $data = [
                'first' => $words,
                'keyword1' => $this->order_id,
                'keyword2' => $this->service->name,
                'keyword3' => $this->price,
                'remark' => '请您尽快登录平台查看',
            ];
            $url = Yii::$app->params['host'] . '/orders/info/' . $this->order_id;
            $weixin->push('vtiNAZx_aMJmP3avh4tVRYK6ViyYrluEbpL5b6IWKMo', $device->device_id, $data, $url);
        }
    }

    public function warn()
    {
        $content = '';
        switch ($this->status) {
            case self::STATUS_NEW:
                $content = Sms::SEND_CODE;
                break;
        }
        if ($content) {
            if ($data = Config::findOne('alert_phone')) {
                Sms::send($data['value'], $content);
            }
            if ($data = Config::findOne('alert_email')) {
                Yii::$app->mailer->compose()
                    ->setFrom('customer-service@eting33.com')
                    ->setTo($data['value'])
                    ->setSubject($content)
                    ->setTextBody($content)
                    ->setHtmlBody('<b>' . $content . '</b>')
                    ->send();
            }
        }
    }

    public function getDoctorName()
    {
        return $this->doctor ? $this->doctor->name : '';
    }

    public function getUserName()
    {
        return $this->user ? $this->user->name : '';
    }

    public function getServiceName()
    {
        if ($this->service) {
            $name = [];
            foreach ($this->service as $s) {
                $name[] = $s->name;
            }
            return implode('，', $name);
        }else{
            return '';
        }
    }

    public function getProductName()
    {
        $name = [];
        foreach ($this->products as $product) {
            $name[] = $product->product->name;
        }
        return implode('|', $name);
    }

    public function getHospitalName()
    {
        return $this->hospital ? $this->hospital->name : '';
    }

    public function getOfficeName()
    {
        return $this->office ? $this->office->name : '';
    }

    public function getSectionName()
    {
        return isset(Office::$time_section[$this->time_section]) ? Office::$time_section[$this->time_section] : '';
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert && $this->hospital_id) {
            $hospital = Hospital::findOne($this->hospital_id);
            if ($hospital && $hospital->contact) {
                Sms::send($hospital->contact, Sms::NEW_APPOINT);
            }
        }
    }

    public function makeOrderId()
    {
        return substr(date('ymdH'), 1) . rand(1000, 9999);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->order_id = $this->makeOrderId();
        }

        return parent::beforeSave($insert);
    }
}
