<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/11
 * Time: 下午3:50
 */

namespace app\modules\mobile\controllers;

use app\models\Hospital;
use app\models\Office;
use app\models\OrderProduct;
use app\models\Orders;
use app\models\Product;
use app\models\Service;
use yii\web\Controller;
use Yii;

class OrdersController extends Controller
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
//                'only' => ['info', 'list', 'new'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionNew($id)
    {
        if (!$id) {
            return $this->redirect('list');
        }

        $doctor_id = Yii::$app->user->id;
        $key = "order:$doctor_id:$id";
        $order = Yii::$app->redis->getHash($key);
        $keyPro = "order_product:$doctor_id:$id";
        $products = Yii::$app->redis->zRange($keyPro, 0, -1, 1);

        if (!isset($order['service'])
            || !isset($order['hospital'])
            || !isset($order['office_id'])
            || !isset($order['appoint_date'])
            || !isset($order['time_section'])
        ) {
            return $this->redirect('/m/doctor/buy/' . $id);
        }

        $model = new Orders();
        $model->service_id = $order['service'];
        $model->hospital_id = $order['hospital'];
        $model->office_id = $order['office_id'];
        $model->appoint_date = $order['appoint_date'];
        $model->time_section = $order['time_section'];
        $model->uid = $id;
        $model->doctor_id = Yii::$app->user->id;

        if ($model->save()) {
            foreach ($products as $pid) {
                $p = new OrderProduct();
                $p->order_id = $model->order_id;
                $p->product_id = $pid;
                $p->save();
            }
            Yii::$app->redis->del($key);
            Yii::$app->redis->del($keyPro);
            $model->push();
            return $this->redirect('/m/doctor/chat-user/' . $id);
        } else {
            return $this->redirect('/m/doctor/buy/' . $id);
        }
    }

    public function actionAccept($id)
    {
        if (!$data = Orders::findOne($id)) {
            return $this->redirect('/m');
        }
        if ($data->uid != Yii::$app->user->id) {
            return $this->redirect('/m');
        }
        $data->status = Orders::STATUS_USER_CONFIRM;
        $data->accept_time = date('Y-m-d H:i:s');
        $data->save();
        $data->push();
        return $this->redirect('/m/orders/info/' . $id);
    }

    public function actionCancel($id)
    {
        if (!$data = Orders::findOne($id)) {
            return $this->redirect('/m');
        }
        if ($data->uid != Yii::$app->user->id) {
            return $this->redirect('/m');
        }
        $data->status = Orders::STATUS_CANCEL;
        $data->close_time = date('Y-m-d H:i:s');
        $data->save();
        $data->push();
        return $this->redirect('/m/orders/info/' . $id);
    }

    public function actionDone($id)
    {
        if (!$data = Orders::findOne($id)) {
            return $this->redirect('/m');
        }
        if ($data->uid != Yii::$app->user->id) {
            return $this->redirect('/m');
        }
        $data->status = Orders::STATUS_FINISH;
        $data->close_time = date('Y-m-d H:i:s');
        $data->save();
        $data->push();
        return $this->redirect('/m/orders/info/' . $id);
    }

    public function actionChange($id)
    {
        if (!$data = Orders::findOne($id)) {
            return $this->redirect('/m');
        }
        if ($data->doctor_id != Yii::$app->user->id) {
            return $this->redirect('/m');
        }
        if ($data->status != Orders::STATUS_NEW) {
            return $this->redirect('/m/orders/info/' . $id);
        }

        $key = "change_order:" . $id;
        $keyPro = "change_order_product:" . $id;
        $service = 0;
        $hospital = 0;
        $office = 0;
        $appoint_date = '';
        $section = 0;
        $p = [];
        if (Yii::$app->request->get('new')) {
            Yii::$app->redis->del($key);
            Yii::$app->redis->set($key, $data->attributes);
            $service = $data->service_id;
            $hospital = $data->hospital_id;
            $office_id = $data->office_id;
            $appoint_date = $data->appoint_date;
            $section = $data->time_section;

            Yii::$app->redis->del($keyPro);
            $prod = OrderProduct::findAll(['order_id' => $id]);
            foreach ($prod as $item) {
                Yii::$app->redis->zAdd($keyPro, $item->product_id, time());
                $p[] = $item->product_id;
            }
        } elseif (Yii::$app->request->get('save')) {
            if (($order = Yii::$app->redis->getHash($key))) {
                $data->service_id = $order['service_id'];
                $data->hospital_id = $order['hospital_id'];
                $data->office_id = $order['office_id'];
                $data->time_section = $order['time_section'];
                $data->appoint_date = $order['appoint_date'];
                $data->save();
                OrderProduct::deleteAll(['order_id' => $id]);
                $p = Yii::$app->redis->zRange($keyPro);
                foreach ($p as $item) {
                    $op = new OrderProduct();
                    $op->order_id = $id;
                    $op->product_id = $item;
                    $op->save();
                }
                $data->push();
            }
            return $this->redirect('/m/orders/info/' . $id);
        } else {
            if ($order = Yii::$app->redis->getHash($key)) {
                if (!isset($order['service_id']) || !isset($order['hospital_id'])) {
                    return $this->redirect('/m/orders/info/' . $id);
                }
                $service = $order['service_id'];
                $hospital = $order['hospital_id'];
                $office = $order['office_id'];
                $section = $order['time_section'];
                $appoint_date = $order['appoint_date'];
            }
            $p = Yii::$app->redis->zRange($keyPro);
        }

        $price = 0;
        if ($service) {
            $s = Service::findOne($service);
            $service_name = $s->name;
            $price += $s->price;
        } else {
            $service_name = '';
        }
        if ($hospital) {
            $hospital_name = Hospital::findOne($hospital)->name;
        } else {
            $hospital_name = '';
        }
        if ($office) {
            $hospital_name .= ' ' . Office::findOne($office)->name;
        }
        if ($appoint_date) {
            $hospital_name .= '<br/><br/>' . $appoint_date;
        }
        if ($section) {
            $hospital_name .= ' ' . Office::$time_section[$section];
        }
        $product = [];
        if ($p) {
            $products = Product::findAll($p);
            foreach ($products as $item) {
                $product[$item->product_id] = $item->name;
                $price += $item->price;
            }
        }

        return $this->render('change', [
            'order_id' => $id,
            'service' => $service_name,
            'hospital' => $hospital_name,
            'product' => $product,
            'price' => $price,
        ]);
    }

    public function actionPay($id)
    {
        if (!$data = Orders::findOne($id)) {
            return $this->redirect('/m');
        }
        if ($data->doctor_id != Yii::$app->user->id) {
            return $this->redirect('/m');
        }
        $data->status = Orders::STATUS_USER_PAY;
        $data->pay_time = date('Y-m-d H:i:s');
        $data->save();
        $data->push();
        return $this->redirect('/m/orders/info/' . $id);
    }

    public function actionInfo($id)
    {
        if (!$data = Orders::findOne($id)) {
            return $this->redirect('/m');
        }
        $price = $data->price;
        return $this->render('info', ['item' => $data, 'price' => $price]);
    }

    public function actionList()
    {
        if (Yii::$app->user->identity->doctor) {
            $order = Orders::find()->where(['doctor_id' => Yii::$app->user->id]);
            $view = 'doctor-list';
        } else {
            $order = Orders::find()->where(['uid' => Yii::$app->user->id]);
            $view = 'list';
        }
        $order->orderBy(['ctime' => SORT_DESC]);
        $running = clone $order;
        $running->andWhere(['status' => [Orders::STATUS_NEW, Orders::STATUS_USER_CONFIRM, Orders::STATUS_USER_PAY]]);
        $order->andWhere(['status' => [Orders::STATUS_FINISH, Orders::STATUS_CANCEL]]);
        $data = array_merge($running->all(), $order->all());
        return $this->render($view, ['data' => $data]);
    }

    public function actionSetService($user_id, $service_id)
    {
        $doctor_id = Yii::$app->user->id;
        $key = "order:$doctor_id:$user_id";
        Yii::$app->redis->set($key, ['service' => $service_id]);
    }

    public function actionSetOrderService($order_id, $service_id)
    {
        $key = "change_order:$order_id";
        Yii::$app->redis->set($key, ['service_id' => $service_id]);
    }

    public function actionAddProduct($user_id, $product_id)
    {
        $doctor_id = Yii::$app->user->id;
        $key = "order_product:$doctor_id:$user_id";
        Yii::$app->redis->zAdd($key, $product_id, time());
    }

    public function actionAddOrderProduct($order_id, $product_id)
    {
        $key = "change_order_product:$order_id";
        Yii::$app->redis->zAdd($key, $product_id, time());
    }

    public function actionDeleteProduct($user_id, $product_id)
    {
        $doctor_id = Yii::$app->user->id;
        $key = "order_product:$doctor_id:$user_id";
        Yii::$app->redis->zRem($key, $product_id);
    }

    public function actionRemoveProduct($id)
    {
        $key = "change_order_product:$id";
        Yii::$app->redis->zRem($key, Yii::$app->request->get('product_id'));
    }


    public function actionSetHospital($user_id, $hospital_id)
    {
        $doctor_id = Yii::$app->user->id;
        $key = "order:$doctor_id:$user_id";
        Yii::$app->redis->set($key, ['hospital' => $hospital_id]);
    }

    public function actionSetOffice($user_id, $office_id)
    {
        $doctor_id = Yii::$app->user->id;
        $key = "order:$doctor_id:$user_id";
        Yii::$app->redis->set($key, ['office_id' => $office_id]);
    }

    public function actionSetDate($user_id, $section_id, $adate)
    {
        $doctor_id = Yii::$app->user->id;
        $key = "order:$doctor_id:$user_id";
        Yii::$app->redis->set($key, ['time_section' => $section_id, 'appoint_date' => $adate]);
    }

    public function actionSetOrderHospital($order_id, $hospital_id)
    {
        $key = "change_order:$order_id";
        Yii::$app->redis->set($key, ['hospital_id' => $hospital_id]);
    }

    public function actionSetOrderOffice($order_id, $office_id)
    {
        $key = "change_order:$order_id";
        Yii::$app->redis->set($key, ['office_id' => $office_id]);
    }

    public function actionSetOrderDate($order_id, $section_id, $adate)
    {
        $key = "change_order:$order_id";
        Yii::$app->redis->set($key, ['time_section' => $section_id, 'appoint_date' => $adate]);
    }

    public function actionChooseService($id)
    {
        $s = Service::getList();
        return $this->render('choose-service', ['service' => $s, 'order_id' => $id]);
    }


    public function actionChooseProduct($id)
    {
        $p = Product::find()->all();
        return $this->render('choose-product', ['product' => $p, 'order_id' => $id]);
    }

    public function actionChooseCenter($id)
    {
        $c = Hospital::find()->all();
        return $this->render('choose-center', ['center' => $c, 'order_id' => $id]);
    }

    public function actionChooseOffice($id)
    {
        $key = "change_order:$id";
        $v = Yii::$app->redis->getHash($key);
        $hospital_id = $v['hospital_id'];

        $c = Office::find()->where(['hospital_id' => $hospital_id])->all();
        return $this->render('choose-office', ['data' => $c, 'order_id' => $id]);
    }

    public function actionChooseDate($id)
    {
        return $this->render('choose-date', ['order_id' => $id]);
    }
}