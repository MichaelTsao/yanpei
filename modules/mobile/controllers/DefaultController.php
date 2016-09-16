<?php

namespace app\modules\mobile\controllers;

use app\models\base\Common;
use app\models\Doctor;
use app\models\SmsCode;
use yii\db\Expression;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'new';
    }

    public function actionIndex()
    {
        if (isset(Yii::$app->user->getIdentity()->doctor) && Yii::$app->user->getIdentity()->doctor) {
            return $this->redirect('/m/doctor/chat-list');
        }
        $data = Doctor::find()
            ->where(['status' => Doctor::STATUS_NORMAL, 'top' => Doctor::TOP_YES])
            ->orderBy(['sort' => SORT_DESC])->all();
//        $chat_doctor = [];
//        $chat = Chat::find()->where(['uid' => Yii::$app->user->id])->orderBy('ctime desc')->all();
        $doctor = Doctor::find()
            ->where(['status' => Doctor::STATUS_NORMAL, 'top' => Doctor::TOP_NO])
            ->orderBy(new Expression('rand()'));
//        if ($chat) {
//            foreach ($chat as $item) {
//                $chat_doctor[] = $item->doctor_id;
//                if ($doc = Doctor::findOne(['uid' => $item->doctor_id])) {
//                    $data[] = $doc;
//                }
//            }
//            $doctor = $doctor->andWhere(['not in', 'uid', $chat_doctor]);
//        }
        $data = array_merge($data, $doctor->all());
        $this->view->params['isHome'] = true;
        return $this->render('index', ['data' => $data]);
    }

    public function actionSendSms()
    {
        if (isset(Yii::$app->user->id)) {
            $uid = Yii::$app->user->id;
        } else {
            $uid = 0;
        }
        $sms_code_config = [
            'uid' => $uid,
            'phone' => Yii::$app->request->get('phone', ''),
            'type' => Yii::$app->request->get('type', SmsCode::TYPE_REGISTER),
            'scenario' => SmsCode::SCENARIO_SEND,
        ];
        $sms_code = new SmsCode($sms_code_config);
        if (!$sms_code->send()) {
            return Common::getFirstError($sms_code);
        } else {
            return 'ok';
        }
    }
}
