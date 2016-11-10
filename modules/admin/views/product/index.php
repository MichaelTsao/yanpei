<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $brandList array */
/* @var $productTypeList \app\models\ProductType[] */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            [
                'attribute' => 'brand',
                'value' => function (\app\models\Product $data) use ($brandList) {
                    return isset($brandList[$data->brand]) ? $brandList[$data->brand] : '';
                },
                'filter' => $brandList,
            ],
            'name',
            [
                'attribute' => 'type',
                'value' => function (\app\models\Product $data) use ($productTypeList) {
                    return isset($productTypeList[$data->type]) ? $productTypeList[$data->type] : '';
                },
                'filter' => $productTypeList,
            ],
            'price',
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => function ($data, $row) {
                    if ($data->icon) {
                        return Html::img($data->icon, ['height' => 50]);
                    } else {
                        return '';
                    }
                }
            ],
            'battery',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {copy} <br/> {up} {down} {top}',
                'buttons' => [
                    'copy' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-duplicate"></span>', '#',
                            [
                                'title' => '复制功能点',
                                'onclick' => "choose(this)",
                                'data-id' => $model->product_id,
                                'data-name' => $model->name,
                            ]);
                    },
                    'up' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                            '/admin/product/up/'.$model->product_id, ['title' => '上移']);
                    },
                    'down' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                            '/admin/product/down/'.$model->product_id, ['title' => '下移']);
                    },
                    'top' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-upload"></span>',
                            '/admin/product/top/'.$model->product_id, ['title' => '置顶']);
                    },
                ],
                'options' => ['width' => '90px'],
            ],
        ],
    ]); ?>

    <?php
    \yii\bootstrap\Modal::begin([
        'header' => '<h2>选择被复制的产品</h2>',
        'id' => 'choose-product',
        'clientOptions' => ['role' => 'dialog'],
        'size' => \yii\bootstrap\Modal::SIZE_SMALL,
    ]);

    echo '<input id="origin" type="hidden">';
    echo '<div id="prod"></div><br/>';
    echo \yii\bootstrap\Html::dropDownList('product', null, \app\models\Product::getList(), ['class' => 'form-control', 'id' => 'from']);
    echo '<br/><div align="center">';
    echo \yii\bootstrap\Html::button('复制', ['class' => 'btn btn-primary', 'onclick' => 'copy()']);
    echo '</div>';

    \yii\bootstrap\Modal::end();
    ?>
</div>

<script>
    function choose(obj) {
        var name = $(obj).attr('data-name');
        $('#origin').val($(obj).attr('data-id'));
        $('#choose-product').on('show.bs.modal', function (event) {
            var modal = $(this);
            modal.find('#prod').text(name + ' 的功能点复制为:')
        });
        $('#choose-product').modal();
    }

    function copy() {
        var origin = $('#origin').val();
        var from = $('#from').val();
        if (from != origin) {
            $.get('/admin/product/duplicate?origin=' + origin + '&from=' + from);
        }
        $('#choose-product').modal('hide');
    }
</script>
