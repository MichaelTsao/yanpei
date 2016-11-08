<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\office */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Offices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/chartist/chartist.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/chart.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs('
    var chart = null;
    chart_init(' . json_encode(\app\models\Office::$time_section) . ');
    chart_change(' . $model->office_id . ');'
);
$this->registerCssFile("/js/chartist/chartist.min.css");
?>

<div class="office-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->office_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->office_id], [
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
            'office_id',
            'name',
            [
                'attribute' => 'hospital_id',
                'value' => \app\models\Hospital::getList()[$model->hospital_id],
            ],
        ],
    ]) ?>

</div>

<div style="margin-bottom: 20px; text-align: center">
    <select onchange="chart_change(<?= $model->office_id ?>)" id="year">
        <option value="2016" <?php if (date('Y') == 2016) echo 'selected' ?>>2016</option>
        <option value="2017" <?php if (date('Y') == 2017) echo 'selected' ?>>2017</option>
        <option value="2018" <?php if (date('Y') == 2018) echo 'selected' ?>>2018</option>
    </select>
    年
    &nbsp;
    <select onchange="chart_change(<?= $model->office_id ?>)" id="month">
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?= $i ?>" <?php if (date('m') == $i) echo 'selected' ?>><?= $i ?></option>
        <?php endfor; ?>
    </select>
    月
</div>

<div class="ct-chart ct-perfect-fourth"></div>
