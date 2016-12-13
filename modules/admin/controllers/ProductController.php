<?php

namespace app\modules\admin\controllers;

use app\models\Brand;
use app\models\Feature;
use app\models\ProductFeature;
use app\models\ProductType;
use Yii;
use app\models\Product;
use app\modules\admin\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'main';
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'user' => 'account',
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['viewer', 'admin', 'product-editor'],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete', 'duplicate', 'up', 'down', 'top'],
                        'allow' => true,
                        'roles' => ['admin', 'product-editor'],
                    ],
                ],
                'denyCallback' => function($rule, $action){
                    return $this->redirect(['index']);
                }
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brandList' => Brand::getList(),
            'productTypeList' => ProductType::getList(),
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $scope = $feature = [];
        foreach ($model->scopes as $fid) {
            $f = Feature::findOne($fid);
            $scope[] = $f->name;
        }
        foreach ($model->features as $fid) {
            $f = Feature::findOne($fid);
            $feature[] = '<h4><span class="label label-primary">' . $f->name . '</span></h4>';
        }
        return $this->render('view', [
            'model' => $model,
            'brandList' => Brand::getList(),
            'productTypeList' => ProductType::getList(),
            'scope' => implode(' ', $scope),
            'feature' => implode(' ', $feature),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            list($not_sel, $sel) = $this->makeFeature();
            return $this->render('create', [
                'model' => $model,
                'not_select' => $not_sel,
                'select' => $sel,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            list($not_sel, $sel) = $this->makeFeature($id);
            return $this->render('update', [
                'model' => $model,
                'not_select' => $not_sel,
                'select' => $sel,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function makeFeature($product_id=0)
    {
        $obj = [];
        $sel = [];
        $not_select = [];
        $select = [];

        $data = Feature::find()->orderBy(['name' => SORT_ASC])->all();

        if ($product_id) {
            foreach ($data as $item) {
                $obj[$item->feature_id] = $item;
            }

            $pf = ProductFeature::find()->where(['product_id' => $product_id])->orderBy(['sort' => SORT_ASC])->all();
            foreach ($pf as $item) {
                $one = $obj[$item->feature_id];
                $select[$one->type][] = $one;
                $sel[$item->feature_id] = 1;
            }
        }

        foreach ($data as $item) {
            if (!isset($sel[$item->feature_id])) {
                $not_select[$item->type][] = $item;
            }
        }

        return [$not_select, $select];
    }

    public function actionDuplicate($origin, $from)
    {
        if ($origin == $from) {
            return;
        }

        ProductFeature::deleteAll(['product_id' => $origin]);
        $data = ProductFeature::find()->where(['product_id' => $from])->orderBy(['sort' => SORT_ASC])->all();
        foreach ($data as $item) {
            $pf = new ProductFeature();
            $pf->product_id = $origin;
            $pf->feature_id = $item->feature_id;
            $pf->sort = $item->sort;
            $pf->save();
        }
    }

    public function actionUp($id)
    {
        $data = Product::find()->orderBy(['sort' => SORT_DESC])->all();
        foreach ($data as $k => $item) {
            if ($item->product_id == $id && $k != 0) {
                $item->sort = $data[$k - 1]->sort + 1;
                $item->save();
            }
        }
        return $this->redirect('/admin/product');
    }

    public function actionDown($id)
    {
        $data = Product::find()->orderBy(['sort' => SORT_DESC])->all();
        foreach ($data as $k => $item) {
            if ($item->product_id == $id && $k != count($data) - 1) {
                $item->sort = $data[$k + 1]->sort - 1;
                $item->save();
            }
        }
        return $this->redirect('/admin/product');
    }

    public function actionTop($id)
    {
        $data = Product::find()->orderBy(['sort' => SORT_DESC])->one();
        $item = Product::findOne($id);
        $item->sort = $data->sort + 1;
        $item->save();
        return $this->redirect('/admin/product');
    }
}
