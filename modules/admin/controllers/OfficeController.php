<?php

namespace app\modules\admin\controllers;

use app\models\Orders;
use Yii;
use app\models\Office;
use app\modules\admin\models\OfficeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfficeController implements the CRUD actions for office model.
 */
class OfficeController extends Controller
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
        ];
    }

    /**
     * Lists all office models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfficeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single office model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new office model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Office();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->office_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing office model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->office_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing office model.
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
     * Finds the office model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return office the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Office::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetTimeSections($office_id, $year, $month)
    {
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $days = [0];
        for ($i = 1; $i <= $number; $i++) {
            $days[] = $i;
        }

        $sections = [];
        for ($i = 1; $i < 5; $i++) {
            $l = [$i];
            for ($j = 1; $j <= $number; $j++) {
                $l[$j] = null;
            }
            $sections[] = $l;
        }
        $data = Orders::find()
            ->where(['office_id' => $office_id])
            ->andWhere(['not', ['status' => Orders::STATUS_CANCEL]])
            ->andWhere(['between', 'appoint_date', "$year-$month-01", "$year-$month-$number"])
            ->all();
        foreach ($data as $item) {
            $day = date('j', strtotime($item->appoint_date));
            $sections[$item->time_section - 1][$day] = $item->time_section;
        }

        return json_encode(['days' => $days, 'sections' => $sections]);
    }
}
