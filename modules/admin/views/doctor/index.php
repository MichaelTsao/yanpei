<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\DoctorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Doctors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a(Yii::t('app', 'Create') . Yii::t('app', 'Doctor'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'name',
            [
                'attribute' => 'cover',
                'format' => 'raw',
                'value' => function ($data, $row) {
                    if ($data->cover) {
                        return Html::img($data->cover, ['height' => 50]);
                    }else{
                        return '';
                    }
                }
            ],
            'education',
            'school',
            'title',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return \app\models\Doctor::$statuses[$data->status];
                },
                'filter' => \app\models\Doctor::$statuses,
            ],
            [
                'attribute' => 'top',
                'value' => function($data){
                    return \app\models\Doctor::$tops[$data->top];
                },
                'filter' => \app\models\Doctor::$tops,
            ],
            // 'company',
            // 'intro:ntext',
            'remark',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} <br/> {up} {down} {top}',
                'buttons' => [
                    'up' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', 
                            '/admin/doctor/up/'.$model->uid, ['title' => '上移']);
                    },
                    'down' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', 
                            '/admin/doctor/down/'.$model->uid, ['title' => '下移']);
                    },
                    'top' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-upload"></span>', 
                            '/admin/doctor/top/'.$model->uid, ['title' => '置顶']);
                    },
                ],
                'options' => ['width' => '70px'],
            ],
        ],
    ]); ?>

</div>
