<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hospital */

$this->title = Yii::t('app', 'Update') . Yii::t('app', 'Hospital') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hospitals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->hospital_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hospital-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
