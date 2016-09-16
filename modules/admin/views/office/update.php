<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\office */

$this->title = Yii::t('app', 'Update') . Yii::t('app', 'Office') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Offices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->office_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="office-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
