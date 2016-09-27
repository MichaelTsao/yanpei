<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Doctor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->uid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->uid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uid',
            'name',
            [
                'attribute' => 'cover',
                'format' => 'raw',
                'value' => Html::img($model->cover, ['height' => 50]),
            ],
            'education',
            'school',
            'title',
            'company',
            'intro:ntext',
            'work_location',
            [
                'attribute' => 'on_job',
                'value' => \app\models\Doctor::$on_jobs[$model->on_job],
            ],
            [
                'attribute' => 'status',
                'value' => \app\models\Doctor::$statuses[$model->status],
            ],
            [
                'attribute' => 'top',
                'value' => \app\models\Doctor::$tops[$model->top],
            ],
            'remark',
        ],
    ]) ?>

</div>
