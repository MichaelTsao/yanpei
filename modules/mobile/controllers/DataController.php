<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/16
 * Time: 上午1:12
 */

namespace app\modules\mobile\controllers;

use app\models\Article;
use app\models\ArticleType;
use app\models\base\Common;
use app\models\Chat;
use app\models\Product;
use app\models\User;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;

class DataController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'new';
    }

    public function actionType()
    {
        $this->view->params['isDataList'] = true;
        $data = ArticleType::find()->all();
        return $this->render('type', ['data' => $data]);
    }

    public function actionList($id = 0)
    {
        $this->view->params['isDataList'] = true;
        $m = Article::find();
        if ($id) {
            $m->where(['type' => $id]);
        }
        $data = $m->orderBy(['sort' => SORT_DESC])->all();
        return $this->render('list', ['data' => $data]);
    }

    public function actionInfo($id)
    {
        $this->view->params['noScroll'] = true;
        return $this->render('info', ['id' => $id]);
    }

    public function actionContent($id)
    {
        $this->layout = false;
        $data = Article::findOne($id);
        return $this->render('content', ['content' => $data->content]);
    }

    public function actionShare($type, $id, $uid = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }

        if ($uid) {
            if (Yii::$app->user->identity->doctor) {
                $param = ['uid' => $uid, 'doctor_id' => Yii::$app->user->id];
            } else {
                $param = ['uid' => Yii::$app->user->id, 'doctor_id' => $uid];
            }
            if ($chat = Chat::findOne($param)) {
                $msg = '';
                $target = ['/'];
                if ($type == 'product') {
                    if ($product = Product::findOne($id)) {
                        $msg = '<a href="' . Url::to(['product/info', 'id' => $id]) . '">' . $product->name . '</a>';
                    }
                    $target = ['product/list'];
                } elseif ($type == 'article') {
                    if ($article = Article::findOne($id)) {
                        $msg = '<a href="' . Url::to(['info', 'id' => $id]) . '">' . $article->title . '</a>';
                    }
                    $target = ['list'];
                }
                if ($msg) {
                    Common::sendMsg($chat->chat_id, Yii::$app->user->id, $uid, $msg);
                }
                return $this->redirect($target);
            }
        }

        $query = Chat::find();
        if (Yii::$app->user->identity->doctor) {
            $query->select(['uid']);
            $query->where(['doctor_id' => Yii::$app->user->id]);
        } else {
            $query->select(['doctor_id']);
            $query->where(['uid' => Yii::$app->user->id]);
        }
        $users = $query->column();
        $userInfo = User::findAll(['uid' => $users]);
        return $this->render('share', ['users' => $userInfo, 'type' => $type, 'id' => $id]);
    }
}