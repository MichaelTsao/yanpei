<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ill */

$this->title = Yii::t('app', 'Update').Yii::t('app', 'Ill') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ill_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
