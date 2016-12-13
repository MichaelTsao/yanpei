<?php

namespace app\modules\admin\controllers;

use app\models\User;
use Yii;
use app\models\Doctor;
use app\modules\admin\models\DoctorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DoctorController implements the CRUD actions for Doctor model.
 */
class DoctorController extends Controller
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
                        'roles' => ['viewer', 'admin', 'doctor-auditor'],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete', 'up', 'down', 'top'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['doctor-auditor'],
                    ],
                ],
                'denyCallback' => function($rule, $action){
                    return $this->redirect(['/admin']);
                }
            ],
        ];
    }

    /**
     * Lists all Doctor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoctorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doctor model.
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
     * Creates a new Doctor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Doctor();
        $user = User::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()
            && $user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
            $model->uid = $id;
            return $this->render('create', [
                'model' => $model,
                'user' => $user,
            ]);
        }
    }

    /**
     * Updates an existing Doctor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = User::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()
            && $user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'user' => $user,
            ]);
        }
    }

    /**
     * Deletes an existing Doctor model.
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
     * Finds the Doctor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Doctor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doctor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUp($id)
    {
        $data = Doctor::find()->orderBy(['sort' => SORT_DESC])->all();
        foreach ($data as $k => $item) {
            if ($item->uid == $id && $k != 0) {
                $item->sort = $data[$k - 1]->sort + 1;
                $item->save();
            }
        }
        return $this->redirect('/admin/doctor');
    }

    public function actionDown($id)
    {
        $data = Doctor::find()->orderBy(['sort' => SORT_DESC])->all();
        foreach ($data as $k => $item) {
            if ($item->uid == $id && $k != count($data) - 1) {
                $item->sort = $data[$k + 1]->sort - 1;
                $item->save();
            }
        }
        return $this->redirect('/admin/doctor');
    }

    public function actionTop($id)
    {
        $data = Doctor::find()->orderBy(['sort' => SORT_DESC])->one();
        $item = Doctor::findOne($id);
        $item->sort = $data->sort + 1;
        $item->save();
        return $this->redirect('/admin/doctor');
    }
}
