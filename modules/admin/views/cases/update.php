<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cases */

$this->title = Yii::t('app', 'Update') . Yii::t('app', 'Cases') . ': ' . $model->case_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->case_id, 'url' => ['view', 'id' => $model->case_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
