<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 上午10:26
 */

namespace app\controllers;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class UserController extends Controller
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
        ];
    }

    public function actionLogin()
    {
        if (Yii::$app->request->get('ajax')) {
            if ($user = User::findOne([
                'phone' => Yii::$app->request->post('phone'),
                'password' => md5(Yii::$app->request->post('password')),
            ])
            ) {
                Yii::$app->user->login($user, 86400 * 30 * 120);
                return 'ok';
            } else {
                return '登录失败';
            }
        }

        return $this->render('login');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/');
    }

    public function actionInfo()
    {
        $user = Yii::$app->user->identity;
        if (Yii::$app->request->isPost) {
            $user->load(Yii::$app->request->post());
            $user->save();
        }
        return $this->render('info', ['user' => $user]);
    }

    public function actionRegister()
    {
        return $this->render('register');
    }
}