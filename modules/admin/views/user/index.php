<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create') . Yii::t('app', 'User'), ['create'], ['class' => 'btn btn-success']) ?>
        &nbsp;&nbsp;
        <?= Html::a('导出', '/res/data.xlsx', ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'phone',
            'name',
            [
                'attribute' => 'gender',
                'value' => 'genderName',
                'filter' => User::$genderLabel,
            ],
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => function ($data, $row) {
                    if ($data->icon) {
                        return Html::img($data->icon, ['height' => 50]);
                    }else{
                        return '';
                    }
                }
            ],
            [
                'attribute' => 'doctor',
                'value' => function($data){
                    return $data->doctor ? '是' : '否';
                },
                'label' => '是否验配师',
            ],
            [
                'attribute' => 'status',
                'value' => 'statusName',
                'filter' => User::$statusLabel,
            ],
            'ctime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {doctor}',
                'buttons' => [
                    'doctor' => function ($url, $model, $key) {
                        return !$model->doctor ? Html::a('<span class="glyphicon glyphicon-education"></span>', '/admin/doctor/create/'.$model->uid) : '';
                    },
                ],
            ],
        ],
    ]); ?>

</div>
