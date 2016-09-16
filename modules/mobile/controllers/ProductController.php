<?php

namespace app\modules\mobile\controllers;

use app\models\Feature;
use app\models\Product;

class ProductController extends \yii\web\Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'new';
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

    public function actionList()
    {
        $this->view->params['isProduct'] = true;
        $data = Product::find()->orderBy(['sort' => SORT_DESC])->all();
        return $this->render('list', ['data' => $data]);
    }

}
