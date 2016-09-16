<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArticleType */

$this->title = Yii::t('app', 'Create') . Yii::t('app', 'Article Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Article Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
