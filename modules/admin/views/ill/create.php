<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ill */

$this->title = Yii::t('app', 'Create').Yii::t('app', 'Ill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
