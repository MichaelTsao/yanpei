<?php

namespace app\controllers;

use app\models\Doctor;
use app\models\Marquee;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (isset(Yii::$app->user->identity->doctor) && Yii::$app->user->identity->doctor) {
            return $this->redirect('/doctor/chat-list');
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
        $this->view->params['isYanpei'] = 1;
        return $this->render('index', ['data' => $data]);
    }
}
