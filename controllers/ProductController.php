<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 下午8:48
 */

namespace app\controllers;

use app\models\Feature;
use app\models\Product;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionList($keyword = '')
    {
        $this->view->params['isProduct'] = 1;
        $this->view->params['keyword'] = $keyword;
        return $this->render('list', ['data' => Product::getData($keyword)]);
    }

    public function actionInfo($id)
    {
        $this->view->params['isProduct'] = true;
        $data = Product::findOne(['product_id' => $id]);

        $scopes = [];
        foreach ($data->scopes as $fid) {
            $d = Feature::findOne($fid);
            $scopes[] = $d->name;
        }

        $features = [];
        foreach ($data->features as $fid) {
            $d = Feature::findOne($fid);
            $features[] = $d->name;
        }

        return $this->render('info', [
            'data' => $data,
            'scope' => $scopes,
            'feature' => $features,
        ]);
    }
}