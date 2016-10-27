<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 上午11:56
 */

namespace app\controllers;

use app\models\Chat;
use app\models\Doctor;
use app\models\Fav;
use app\models\Hospital;
use app\models\LeanCloud;
use app\models\Office;
use app\models\Orders;
use app\models\Product;
use app\models\Service;
use app\models\User;
use yii\web\Controller;
use Yii;

class DoctorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['chat', 'chat-list', 'fav', 'apply'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionSearch($keyword = '')
    {
        $this->view->params['keyword'] = $keyword;
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->doctor) {
            $list = Chat::find()
                ->joinWith('user')
                ->where(['doctor_id' => Yii::$app->user->id])
                ->andWhere(['like', 'user.name', $keyword])
                ->orderBy(['last_time' => SORT_DESC])->all();
            return $this->render('chat-list', ['data' => $list]);
        }else{
            $data = Doctor::find()->where(['like', 'name', $keyword])->all();
            return $this->render('/site/index', ['data' => $data, 'ad' => false]);
        }
    }

    public function actionInfo($id)
    {
        $this->view->params['isYanpei'] = 1;
        $info = Doctor::findOne($id);
        $hasFav = Fav::findOne(['uid' => Yii::$app->user->id, 'doctor_id' => $id]);
        $this->view->params['doctor_info'] = $info;
        return $this->render('info', ['info' => $info, 'hasFav' => $hasFav]);
    }

    public function actionChat($id)
    {
        if ($id == Yii::$app->user->id) {
            return $this->redirect('/');
        }

        if (!$chat = Chat::findOne(['uid' => Yii::$app->user->id, 'doctor_id' => $id])) {
            $chat_id = LeanCloud::createConversation([Yii::$app->user->id, $id]);
            $chat = new Chat();
            $chat->chat_id = $chat_id;
            $chat->uid = Yii::$app->user->id;
            $chat->doctor_id = $id;
            $chat->save();
        } else {
            $chat_id = $chat->chat_id;
        }

        $doctor = Doctor::findOne($id);
        $order = Orders::find()->where(['uid' => Yii::$app->user->id, 'doctor_id' => $doctor->uid])
            ->andWhere(['not', ['status' => [Orders::STATUS_FINISH, Orders::STATUS_CANCEL]]])->one();
        $param = [
            'me' => Yii::$app->user->identity,
            'other' => $doctor->user,
            'chat_id' => $chat_id,
            'order' => $order,
        ];

        return $this->render('chat', $param);
    }

    public function actionChatUser($id)
    {
        if ($id == Yii::$app->user->id) {
            return $this->redirect('/doctor/chat-list');
        }
        if (!$chat = Chat::findOne(['uid' => $id, 'doctor_id' => Yii::$app->user->id])) {
            return $this->redirect('/doctor/chat-list');
        } else {
            $chat_id = $chat->chat_id;
        }
        $user = User::findOne($id);
        $order = Orders::find()->where(['doctor_id' => Yii::$app->user->id, 'uid' => $id])
            ->andWhere(['not', ['status' => [Orders::STATUS_FINISH, Orders::STATUS_CANCEL]]])->one();
        $param = [
            'me' => Yii::$app->user->identity,
            'other' => $user,
            'chat_id' => $chat_id,
            'order' => $order,
        ];

        return $this->render('chat', $param);
    }

    public function actionChatList()
    {
        $list = Chat::find()->where(['doctor_id' => Yii::$app->user->id])->orderBy(['last_time' => SORT_DESC])->all();
        return $this->render('chat-list', ['data' => $list]);
    }

    public function actionBuy($id)
    {
        $info = Doctor::findOne(Yii::$app->user->id);
        $doctor_id = Yii::$app->user->id;
        $price = 0;

        $key = "order:$doctor_id:$id";
        $order = Yii::$app->redis->getHash($key);

        if (isset($order['service']) && ($s = Service::findOne(['service_id' => $order['service']]))) {
            $service_name = $s->name;
            $price += $s->price;
        } else {
            $service_name = '';
        }

        if (isset($order['hospital']) && ($s = Hospital::findOne(['hospital_id' => $order['hospital']]))) {
            $hospital_name = $s->name;
        } else {
            $hospital_name = '';
        }
        if (isset($order['office_id']) && $order['office_id']) {
            $hospital_name .= ' ' . Office::findOne($order['office_id'])->name;
        }
        if (isset($order['appoint_date'])) {
            $hospital_name .= '&nbsp;&nbsp;&nbsp;&nbsp;' . $order['appoint_date'];
        }
        if (isset($order['time_section']) && isset(Office::$time_section[$order['time_section']])) {
            $hospital_name .= ' ' . Office::$time_section[$order['time_section']];
        }

        $prod = [];
        $key = "order_product:$doctor_id:$id";
        if (($products = Yii::$app->redis->zRange($key, 0, -1, 1)) && ($p = Product::findAll($products))) {
            foreach ($p as $item) {
                $prod[$item->product_id] = $item->name;
                $price += $item->price;
            }
        }

        $param = [
            'info' => $info,
            'service' => $service_name,
            'product' => $prod,
            'hospital' => $hospital_name,
            'uid' => $id,
            'price' => $price,
        ];
        return $this->render('buy', $param);
    }

    public function actionChooseService($id)
    {
        $s = Service::getList();
        return $this->render('choose-service', ['service' => $s, 'user_id' => $id]);
    }

    public function actionChooseProduct($id)
    {
        $p = Product::find()->all();
        return $this->render('choose-product', ['product' => $p, 'user_id' => $id]);
    }

    public function actionChooseCenter($id)
    {
        $c = Hospital::find()->all();
        return $this->render('choose-center', ['center' => $c, 'user_id' => $id]);
    }

    public function actionChooseOffice($id)
    {
        $doctor_id = Yii::$app->user->id;
        $key = "order:$doctor_id:$id";
        $v = Yii::$app->redis->getHash($key);
        $hospital_id = $v['hospital'];

        $c = Office::find()->where(['hospital_id' => $hospital_id])->all();
        return $this->render('choose-office', ['data' => $c, 'user_id' => $id]);
    }

    public function actionChooseDate($id)
    {
        return $this->render('choose-date', ['user_id' => $id]);
    }

    public function actionFavorite()
    {
        $docId = [];
        $data = Fav::findAll(['uid' => Yii::$app->user->id]);
        foreach ($data as $item) {
            $docId[] = $item->doctor_id;
        }
        $doc = Doctor::findAll($docId);
        return $this->render('fav', ['data' => $doc]);
    }

    public function actionApply()
    {
        $doctor = new Doctor();
        $user = Yii::$app->user->identity;

        if (Yii::$app->request->isPost) {
            if ($d = Doctor::findOne($user->uid)) {
                if ($d->status == Doctor::STATUS_APPLY) {
                    $doctor->addError('uid', '此用户已经提交过验配师申请');
                } else {
                    $doctor->addError('uid', '此用户已经是验配师');
                }
            } else {
                if ($doctor->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
                    $doctor->uid = $user->uid;
                    $doctor->status = Doctor::STATUS_APPLY;

                    if ($user->save() && $doctor->save()) {
                        return $this->redirect('/user/info');
                    }
                }
            }
        }

        return $this->render('apply', ['doctor' => $doctor, 'user' => $user]);
    }
}