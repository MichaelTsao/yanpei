<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'phone',
            'name',
            [
                'attribute' => 'gender',
                'value' => $model->genderName,
            ],
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => Html::img($model->icon, ['height' => 50]),
            ],
            'age',
            [
                'attribute' => 'id_type',
                'value' => $model->idTypeName,
            ],
            'id_number',
            'email:email',
            'address',
            'profession',
            [
                'attribute' => 'relation',
                'value' => $model->relationName,
            ],
            'relative_name',
            'relative_contact',
            [
                'attribute' => 'status',
                'value' => $model->statusName,
            ],
            'ctime',
        ],
    ]) ?>

</div>
