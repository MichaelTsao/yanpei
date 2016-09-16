<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
            'title',
            [
                'attribute' => 'type',
                'value' => 'typeName',
                'filter' => \app\models\ArticleType::getList(),
            ],
//            'content:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} <br/> {up} {down} {top}',
                'buttons' => [
                    'up' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                            '/admin/article/up/'.$model->id, ['title' => '上移']);
                    },
                    'down' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                            '/admin/article/down/'.$model->id, ['title' => '下移']);
                    },
                    'top' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-upload"></span>',
                            '/admin/article/top/'.$model->id, ['title' => '置顶']);
                    },
                ],
                'options' => ['width' => '70px'],
            ],
        ],
    ]); ?>

</div>
