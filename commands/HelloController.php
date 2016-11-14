<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\base\DeviceUser;
use app\models\Cases;
use app\models\Chat;
use app\models\Doctor;
use app\models\DoctorService;
use app\models\Fav;
use app\models\OrderProduct;
use app\models\Orders;
use app\models\Sms;
use app\models\User;
use app\models\UserToken;
use yii\console\Controller;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    protected $ids = [];

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        Yii::$app->mailer->compose()
            ->setFrom('customer-service@eting33.com')
            ->setTo('caoxiang@yeah.net')
            ->setSubject('test')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
        echo $message . "\n";
    }

    public function actionTest()
    {
        var_dump(Sms::send('13501123150', Sms::SEND_CODE));
    }

    public function actionVerify($code)
    {
        var_dump(Sms::verify('13501123150', $code));
    }

    public function changeId($one, $key = 'uid')
    {
        if (isset($this->ids[$one->$key])) {
            $one->$key = $this->ids[$one->$key];
        }
        return $one;
    }

    public function actionChangeUid()
    {
        $this->ids = [];
        $users = User::find()->all();
        foreach ($users as $user) {
            $old_id = $user->uid;
            if ($old_id < 1000) {
                $uid = $user->makeUserId();
                usleep(100);
                $user->uid = $uid;
                $user->save();
                $this->ids[$old_id] = $uid;
            }
        }
        $list = Doctor::find()->all();
        foreach ($list as $one) {
            DoctorService::deleteAll(['uid' => $one->uid]);
            $one = $this->changeId($one);
            $one->save();
        }

        $tokens = UserToken::find()->all();
        foreach ($tokens as $token) {
            $token = $this->changeId($token);
            $token->save();
        }

        $orders = Orders::find()->all();
        foreach ($orders as $order) {
            $order = $this->changeId($order);
            $order = $this->changeId($order, 'doctor_id');
            $order->save();
        }

        $favs = Fav::find()->all();
        foreach ($favs as $fav) {
            $fav = $this->changeId($fav);
            $fav = $this->changeId($fav, 'doctor_id');
            $fav->save();
        }

        $list = DeviceUser::find()->all();
        foreach ($list as $one) {
            $one = $this->changeId($one);
            $one->save();
        }

        $list = Chat::find()->all();
        foreach ($list as $one) {
            $one = $this->changeId($one);
            $one = $this->changeId($one, 'doctor_id');
            $one->save();
        }

        $list = Cases::find()->all();
        foreach ($list as $one) {
            $one = $this->changeId($one);
            $one = $this->changeId($one, 'doctor_id');
            $one->save();
        }
    }

    public function actionChangeOid()
    {
        $this->ids = [];
        $orders = Orders::find()->all();
        foreach ($orders as $order) {
            $old_id = $order->order_id;
            if ($old_id < 1000) {
                $oid = $order->makeOrderId();
                usleep(100);
                $order->order_id = $oid;
                $order->save();
                $this->ids[$old_id] = $oid;
            }
        }
        $list = OrderProduct::find()->all();
        foreach ($list as $one) {
            $one = $this->changeId($one, 'order_id');
            $one->save();
        }
    }
}
