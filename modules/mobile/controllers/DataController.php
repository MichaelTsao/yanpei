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
use yii\web\Controller;

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

    public function actionList($id=0)
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
//        $this->layout = 'article';
//        $data = Article::findOne($id);
        return $this->render('info', ['id' => $id]);
    }

    public function actionContent($id)
    {
        $this->layout = false;
        $data = Article::findOne($id);
        return $this->render('content', ['content' => $data->content]);
    }
}