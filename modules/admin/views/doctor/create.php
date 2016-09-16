<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Doctor */
/* @var $user app\models\User */

$this->title = Yii::t('app', 'Create') . Yii::t('app', 'Doctor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
    ]) ?>

</div>
