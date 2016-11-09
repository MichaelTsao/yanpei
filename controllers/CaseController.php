<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/27
 * Time: 下午8:12
 */

namespace app\controllers;

use app\models\Cases;
use app\models\Chat;
use yii\web\Controller;
use Yii;

class CaseController extends Controller
{
    public function actionList($id = '')
    {
        if (Yii::$app->user->identity->doctor) {
            $data = Cases::findAll(['doctor_id' => Yii::$app->user->id]);
            $uids = [];
            $chat = Chat::findAll(['doctor_id' => Yii::$app->user->id]);
            foreach ($chat as $item) {
                $uids[] = $item->uid;
            }
            $data_user = Cases::findAll(['uid' => $uids, 'doctor_id' => null]);
            $data = array_merge($data, $data_user);
            if ($id) {
                $can_create = true;
            } else {
                $can_create = false;
            }
        } else {
            $can_create = true;
//            if ($data = Cases::find()->where(['uid' => Yii::$app->user->id, 'doctor_id' => null])->all()) {
//                $can_create = false;
//            } else {
//                $can_create = true;
//            }
        }
        return $this->render('list', ['data' => $data, 'id' => $id, 'can_create' => $can_create]);
    }

    public function actionInfo($id)
    {
        $can_edit = true;
        $info = Cases::findOne($id);
        if (Yii::$app->user->identity->doctor) {
            $uids = [];
            $chat = Chat::findAll(['doctor_id' => Yii::$app->user->id]);
            foreach ($chat as $item) {
                $uids[] = $item->uid;
            }
            if ($info->doctor_id != Yii::$app->user->id && !in_array($info->uid, $uids)) {
                return $this->redirect('/');
            }
            if ($info->doctor_id != Yii::$app->user->id) {
                $can_edit = false;
            }
        } else {
            if ($info->uid != Yii::$app->user->id) {
                return $this->redirect('/');
            }
        }
        return $this->render('info', ['info' => $info, 'can_edit' => $can_edit]);
    }

    public function actionNew($id = '')
    {
        $type = Yii::$app->request->get('type', 1);
        $model = new Cases();
        $model->type = $type;

        if (!Yii::$app->user->identity->doctor) {
            $uid = Yii::$app->user->id;
            $doctor_id = null;
        } else {
            if (Chat::findOne(['uid' => $id, 'doctor_id' => Yii::$app->user->id])) {
                $uid = $id;
                $doctor_id = Yii::$app->user->id;
            } else {
                return $this->redirect('/case/list');
            }
        }

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->uid = $uid;
                $model->doctor_id = $doctor_id;
                if ($model->save()) {
                    $url = '/case/list';
                    if ($id) {
                        $url .= "/$id";
                    }
                    return $this->redirect($url);
                }
            }
        }

        return $this->render('new', ['id' => $id, 'model' => $model, 'type' => $type]);
    }

    public function actionUpdate($id)
    {
        $model = Cases::findOne($id);

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $url = '/case/list';
                return $this->redirect($url);
            }
        }

        return $this->render('new', ['model' => $model, 'type' => $model->type]);
    }
}