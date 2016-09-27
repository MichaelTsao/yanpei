<?php

namespace app\modules\admin\controllers;

use app\models\base\Common;
use app\models\Export;
use Yii;
use app\models\Chat;
use app\modules\admin\models\ChatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
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
     * Lists all Chat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chat model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $chat = array_reverse(json_decode(Common::getChatInfo($model->chat_id), true));
        $export_info = [];
        foreach ($chat as $key => $item) {
            $chat[$key]['info'] = $info = json_decode($item['data'], true);

            if ($item['from'] == $model->uid) {
                $role = '用户';
                $name = $model->user->name;
            } else {
                $role = '验配师';
                $name = $model->doctor->user->name;
            }
            if (strstr($item['data'], '_lcfile')) {
                $content = $info['_lcfile']['url'];
            } elseif (isset($info['_lctext'])) {
                $content = $info['_lctext'];
            } else {
                $content = $item['data'];
            }
            $export_info[] = [$role, $name, date('Y-m-d H:i:s', $item['timestamp'] / 1000), $content];
        }
        Export::makeRaw($export_info, ['角色', '名字', '时间', '聊天内容']);

        return $this->render('view', [
            'model' => $model,
            'chat' => $chat,
        ]);
    }

    /**
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->chat_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Chat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->chat_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Chat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
