<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Marquee */

$this->title = Yii::t('app', 'Create') . Yii::t('app', 'Marquee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Marquees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marquee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
