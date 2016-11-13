<?php

namespace app\modules\mobile\controllers;

use app\models\base\DeviceUser;
use app\models\base\WeiXinSDK;
use app\models\Chat;
use app\models\DoctorService;
use app\models\Fav;
use app\models\Hospital;
use app\models\LeanCloud;
use app\models\Office;
use app\models\Orders;
use app\models\Product;
use app\models\Service;
use app\models\User;
use yii\web\Controller;
use app\models\Doctor;
use app\models\base\Common;
use Yii;

class DoctorController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'new';
    }

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

    public function actionInfo($id)
    {
        $info = Doctor::findOne($id);
        $hasFav = Fav::findOne(['uid' => Yii::$app->user->id, 'doctor_id' => $id]);
        $this->view->params['doctor_info'] = $info;
        return $this->render('info', ['info' => $info, 'hasFav' => $hasFav]);
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
            $hospital_name .= '<br/><br/>' . $order['appoint_date'];
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

    public function actionChatList($keyword = '')
    {
        $list = Chat::getList(Yii::$app->user->id, $keyword);
        return $this->render('chat-list', ['data' => $list, 'keyword' => $keyword]);
    }

    public function actionChat($id)
    {
        if ($id == Yii::$app->user->id) {
            return $this->redirect('/m');
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

        $this->layout = 'chat';
        return $this->render('chat', $param);
    }

    public function actionChatUser($id)
    {
        if ($id == Yii::$app->user->id) {
            return $this->redirect('/m/doctor/chat-list');
        }
        if (!$chat = Chat::findOne(['uid' => $id, 'doctor_id' => Yii::$app->user->id])) {
            return $this->redirect('/m/doctor/chat-list');
        } else {
            $chat_id = $chat->chat_id;
        }
        $user = User::findOne($id);
        if (!$user) {
            return $this->redirect('/m/doctor/chat-list');
        }
        $order = Orders::find()->where(['doctor_id' => Yii::$app->user->id, 'uid' => $id])
            ->andWhere(['not', ['status' => [Orders::STATUS_FINISH, Orders::STATUS_CANCEL]]])->one();
        $param = [
            'me' => Yii::$app->user->identity,
            'other' => $user,
            'chat_id' => $chat_id,
            'order' => $order,
        ];

        $this->layout = 'chat';
        return $this->render('chat', $param);
    }

    public function actionSearch($keyword = '', $location = '', $service = '')
    {
        $query = Doctor::find();
        if ($keyword) {
            $query->andWhere(['like', 'name', $keyword]);
        }
        if ($location) {
            $query->andWhere(['work_location' => $location]);
        }
        if ($service) {
            $ds = DoctorService::find()->where(['service_id' => $service])->select(['uid'])->asArray()->column();
            $query->andWhere(['uid' => $ds]);
        }
        $data = $query->all();
        return $this->render('/default/index', ['data' => $data, 'keyword' => $keyword,
            'location' => $location, 'service' => $service]);
    }

    public function actionFav($id, $type = 1)
    {
        if ($type) {
            $f = new Fav();
            $f->uid = Yii::$app->user->id;
            $f->doctor_id = $id;
            $f->save();
            return '1';
        } else {
            Fav::deleteAll(['uid' => Yii::$app->user->id, 'doctor_id' => $id]);
            return '0';
        }
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

    public function actionTalk($chat_id, $msg)
    {
        Chat::updateAll(['last_msg' => $msg, 'last_time' => date('Y-m-d H:i:s')], ['chat_id' => $chat_id]);

        if ($chat = Chat::findOne(['chat_id' => $chat_id])) {
            if (Yii::$app->user->getIdentity()->doctor) {
                $uid = $chat->uid;
                $url = Yii::$app->params['host'] . '/doctor/chat/' . $chat->doctor_id;
                $name = $chat->user->name;
            } else {
                $uid = $chat->doctor_id;
                $url = Yii::$app->params['host'] . '/doctor/chat-user/' . $chat->uid;
                $name = $chat->doctor->name;
            }
            if ($device = DeviceUser::findOne(['uid' => $uid, 'type' => DeviceUser::TYPE_H5])) {
                $weixin = new WeiXinSDK([
                    'appId' => Yii::$app->params['weixin_id'],
                    'appSecret' => Yii::$app->params['weixin_key'],
                ]);
                $data = [
                    'first' => '您有来自新的聊天信息',
                    'keyword1' => $name,
                    'keyword2' => date('Y年m月d日 H点i分'),
                    'remark' => '请您尽快查看',
                ];
                $weixin->push('RgXH4OesiSn-EvpfQpZelvXW8XT7jtSOcuiCSwHDvjs', $device->device_id, $data, $url);
            }
        }
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

    public function actionApply()
    {
        $error = $name = $age = $cover = $hospital = $title = $location = $desc = '';
        $service = Service::findAll(['status' => Service::STATUS_ACTIVE]);

        if (Yii::$app->request->isPost) {
            if (!$name = Yii::$app->request->post('name')) {
                $error = '请填写名字';
            }
            if (!$age = Yii::$app->request->post('age')) {
                $error = '请填写年龄';
            }
            if (!$cover = Yii::$app->request->post('cover')) {
                $error = '请选择封面';
            }
            if (!$hospital = Yii::$app->request->post('hospital')) {
                $error = '请填写医院';
            }
            if (!$title = Yii::$app->request->post('title')) {
                $error = '请填写职称';
            }
            if (!$location = Yii::$app->request->post('location')) {
                $error = '请填写工作地';
            }
            if (!$desc = Yii::$app->request->post('desc')) {
                $error = '请填写个人描述';
            }
            if (!$error) {
                $user = Yii::$app->user->getIdentity();
                if (!Doctor::findOne($user->uid)) {
                    $user->age = $age;
                    $user->save();

                    $doctor = new Doctor();
                    $doctor->uid = $user->uid;
                    $doctor->name = $name;
                    $doctor->cover = '/cover/' . $cover;
                    $doctor->title = $title;
                    $doctor->company = $hospital;
                    $doctor->work_location = $location;
                    $doctor->intro = $desc;
                    $doctor->status = Doctor::STATUS_APPLY;
                    $doctor->save();

                    foreach ($service as $item) {
                        if (Yii::$app->request->post('service' . $item->service_id)) {
                            $s = new DoctorService();
                            $s->uid = $user->uid;
                            $s->service_id = $item->service_id;
                            $s->save();
                        }
                    }
                    return $this->redirect('/m/user/info');
                }
            }
        }

        return $this->render('apply', ['error' => $error,
            'name' => $name, 'age' => $age, 'cover' => $cover, 'hospital' => $hospital, 'title' => $title,
            'location' => $location, 'desc' => $desc, 'service' => $service]);
    }

    public function actionUploadCover()
    {
        if (isset($_POST['cover'])) {
            list($r, $msg) = Common::uploadImage('cover', Yii::$app->user->id);
            return json_encode(['r' => $r, 'm' => $msg]);
        } else {
            return json_encode(['r' => 1, 'm' => '参数错误']);
        }
    }
}
