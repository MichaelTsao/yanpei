<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/3
 * Time: 下午3:25
 */

namespace app\modules\mobile\controllers;

use app\models\base\Common;
use app\models\base\DeviceUser;
use app\models\base\WeiXinSDK;
use app\models\User;
use app\models\SmsCode;
use yii\web\Controller;
use Yii;

class UserController extends Controller
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
                'only' => ['info', 'change-phone', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        require_once Yii::getAlias('@vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php');
        $detect = new \Mobile_Detect;
        if (!$detect->isMobile()) {
            return $this->redirect('/user/login');
        }

        $key = 'weixin_openid';
        $open_id = Yii::$app->request->cookies->get($key);

        if (Yii::$app->request->get('ajax')) {
            if ($user = User::findOne([
                'phone' => Yii::$app->request->post('phone'),
                'password' => md5(Yii::$app->request->post('password')),
            ])
            ) {
                Yii::$app->user->login($user, 86400 * 30);

                if ($open_id) {
                    DeviceUser::create($user->uid, $open_id, DeviceUser::TYPE_H5);
                }

                return 'ok';
            } else {
                return '登录失败';
            }
        }

        $weixin = new WeiXinSDK([
            'appId' => Yii::$app->params['weixin_id'],
            'appSecret' => Yii::$app->params['weixin_key'],
        ]);
        if ($weixin->isWeixin && !$open_id) {
            if ($weixin->getWebToken() == WeiXinSDK::NEED_REDIRECT) {
                return $this->redirect($weixin->redirect_url);
            }
            $open_id = $weixin->openId;
            Yii::$app->response->cookies->add(
                new \yii\web\Cookie(['name' => $key, 'value' => $open_id, 'expire' => time() + 86400 * 30])
            );
        }

        return $this->render('login');
    }

    public function actionLogout()
    {
        $key = 'weixin_openid';
        $open_id = Yii::$app->request->cookies->get($key);
        $weixin = new WeiXinSDK([
            'appId' => Yii::$app->params['weixin_id'],
            'appSecret' => Yii::$app->params['weixin_key'],
        ]);
        if ($weixin->isWeixin && !$open_id) {
            if ($weixin->getWebToken() == WeiXinSDK::NEED_REDIRECT) {
                return $this->redirect($weixin->redirect_url);
            }
            $open_id = $weixin->openId;
            Yii::$app->response->cookies->add(
                new \yii\web\Cookie(['name' => $key, 'value' => $open_id, 'expire' => time() + 86400 * 30])
            );
        }

        if ($open_id) {
            DeviceUser::remove(Yii::$app->user->id, $open_id);
        }

        Yii::$app->user->logout();

        return $this->redirect('/m/');
    }

    public function actionRegister()
    {
        $sms_code_config = [
            'phone' => Yii::$app->request->post('phone', ''),
            'code' => Yii::$app->request->post('code', ''),
            'type' => SmsCode::TYPE_REGISTER,
            'scenario' => SmsCode::SCENARIO_CHECK,
        ];
        $sms_code = new SmsCode($sms_code_config);
        if (!$sms_code->check()) {
            $this->view->params['error'] = Common::getFirstError($sms_code);
            return $this->render('register');
        }

        $user_config = [
            'phone' => Yii::$app->request->post('phone', ''),
            'passwordRaw' => Yii::$app->request->post('password', ''),
            'name' => Yii::$app->request->post('name', ''),
//            'gender' => Yii::$app->request->post('gender', ''),
        ];
        $user = new User($user_config);
        if (!$user->validate() || !$user->save()) {
            $this->view->params['error'] = Common::getFirstError($user);
            return $this->render('register');
        }

        Yii::$app->user->login($user, 86400 * 30);
        if ($open_id = Yii::$app->request->cookies->get('weixin_openid')) {
            DeviceUser::create($user->uid, $open_id, DeviceUser::TYPE_H5);
        }

        return $this->redirect('/m');
    }

    public function actionRegisterSecond()
    {
        if (!Yii::$app->request->isPost) {
            return $this->render('register');
        }

        if (!$info = Yii::$app->request->cookies->get('register_info')) {
            return $this->redirect(['login', 'type' => 'register']);
        }

        $sms_code_config = [
            'phone' => $info->value['phone'],
            'code' => $info->value['code'],
            'type' => SmsCode::TYPE_REGISTER,
            'scenario' => SmsCode::SCENARIO_CHECK,
        ];
        $sms_code = new SmsCode($sms_code_config);
        if (!$sms_code->check()) {
            $this->view->params['error'] = Common::getFirstError($sms_code);
            return $this->redirect(['login', 'type' => 'register']);
        }

        $user_config = [
            'phone' => $info->value['phone'],
            'passwordRaw' => $info->value['password'],
            'name' => Yii::$app->request->post('name', ''),
            'gender' => Yii::$app->request->post('gender', ''),
        ];
        $user = new User($user_config);
        if (!$user->validate() || !$user->save()) {
            $this->view->params['error'] = Common::getFirstError($user);
            return $this->render('register-second');
        }

        return $this->redirect('/m');
    }

    public function actionForgetPassword()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/m');
        }

        if (Yii::$app->request->isPost) {
            $sms_code_config = [
                'phone' => Yii::$app->request->post('phone', ''),
                'code' => Yii::$app->request->post('sms_code', ''),
                'type' => SmsCode::TYPE_RESET_PASSWORD,
                'scenario' => SmsCode::SCENARIO_CHECK,
            ];
            $sms_code = new SmsCode($sms_code_config);
            if (!$sms_code->check()) {
                return Common::getFirstError($sms_code);
            }

            $user = User::findByPhone($sms_code_config['phone']);
            if (!$user) {
                return '用户不存在';
            }
            $user->passwordRaw = Yii::$app->request->post('password');
            if (!$user->validate() || !$user->save()) {
                return Common::getFirstError($user);
            }

            return 'ok';
        }

        return $this->render('forget-password');
    }

    public function actionInfo()
    {
        $this->view->params['isUserInfo'] = true;
        return $this->render('info', ['user' => Yii::$app->user->identity]);
    }

    public function actionChangePhone()
    {
        if (Yii::$app->request->isPost) {
            $phone = Yii::$app->request->post('phone');
            $code = Yii::$app->request->post('code');

            $sms_code_config = [
                'uid' => Yii::$app->user->id,
                'phone' => $phone,
                'code' => $code,
                'type' => SmsCode::TYPE_CHANGE_PHONE,
                'scenario' => SmsCode::SCENARIO_CHECK,
            ];
            $sms_code = new SmsCode($sms_code_config);
            if (!$sms_code->check()) {
                return Common::getFirstError($sms_code);
            }

            $user = Yii::$app->user->getIdentity();
            $user->phone = $phone;
            $user->save();

            return 'ok';
        }

        return $this->render('change-phone');
    }

    public function actionChangePassword()
    {
        if (Yii::$app->request->isPost) {
            $old_password = Yii::$app->request->post('old_password');
            $password = Yii::$app->request->post('password');

            $user = Yii::$app->user->getIdentity();
            if ($user->password != md5($old_password)) {
                return '原密码错误';
            }
            $user->passwordRaw = $password;
            $user->save();
            return 'ok';
        }
        return $this->render('change-password');
    }

    public function actionChangeIcon()
    {
        if (Yii::$app->request->isPost) {
            if (isset($_POST['icon'])) {
                list($r, $msg) = Common::uploadImage('icon', Yii::$app->user->id);
            } else {
                return '参数错误';
            }
            if ($r == 0) {
                $user = Yii::$app->user->getIdentity();
                $user->icon = '/icon/' . $msg;
                $user->save();
                return 'ok';
            }
            return $msg;
        }
    }

    public function actionChangeName()
    {
        if (Yii::$app->request->isPost) {
            if ($name = Yii::$app->request->post('info')) {
                $user = Yii::$app->user->getIdentity();
                $user->name = $name;
                $user->save();
                return $this->redirect('/m/user/info');
            }
        }
        return $this->render('change-name', ['realname' => Yii::$app->user->getIdentity()->name]);
    }

    public function actionChangeGender()
    {
        if (Yii::$app->request->isPost) {
            if ($gender = Yii::$app->request->post('info')) {
                $user = Yii::$app->user->getIdentity();
                $user->gender = $gender;
                $user->save();
                return $this->redirect('/m/user/info');
            }
        }
        return $this->render('change-gender', ['gender' => Yii::$app->user->getIdentity()->gender]);
    }
}