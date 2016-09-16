<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 下午10:37
 */

namespace app\controllers;

use app\models\Article;
use yii\web\Controller;

class ArticleController extends Controller
{
    public function actionList($id=0)
    {
        $this->view->params['isKnow'] = true;
        $m = Article::find();
        if ($id) {
            $m->where(['type' => $id]);
        }
        $data = $m->orderBy(['sort' => SORT_DESC])->all();
        return $this->render('list', ['data' => $data]);
    }

    public function actionContent($id)
    {
        $this->layout = false;
        $data = Article::findOne($id);
        return $this->render('content', ['content' => $data->content]);
    }

    public function actionInfo($id)
    {
        $this->view->params['isKnow'] = true;
        return $this->render('info', ['id' => $id]);
    }
}