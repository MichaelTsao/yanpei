<?php
/**
 * @var $this yii\web\View
 * @var $scope array
 * @var $feature array
 * @var $data app\models\Product
 */
?>

<div class="product-configure">
    <dl>
        <dt style="background: url('<?= $data->icon ?>') no-repeat center center; background-size: cover;"></dt>
        <dd>
            <h1><?= $data->name ?></h1>
            <h2>
                <span>价格：</span>
                <span><b>￥</b><b><?= $data->price ?></b></span>
            </h2>
            <p>
                <span>
                    <b>验配范围：</b>
                    <?php foreach ($scope as $item): ?>
                        <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?= $item ?></b>
                    <?php endforeach; ?>
                </span>
                <br/>
                <br/>
                <span>
                   <b>电池：</b><b><?= $data->battery ?></b>
                </span>
            </p>
            <p>&nbsp;</p>
            <?php if($data->buy_url): ?>
            <a href="<?= $data->buy_url ?>" target="_blank" style="width:90px;height:36px;color: #ffffff;
                background: #2eaef5;
                border-radius: 4px;
                text-align: center;
                line-height: 36px;
                font-size: 1.4rem;">
                &nbsp;&nbsp;购买&nbsp;&nbsp;
            </a>
            <?php endif ?>
            <a href="<?= \yii\helpers\Url::to(['data/share', 'type' => 'product', 'id' => $data->product_id]) ?>">
                <img src="/images/share.png" style="width: 20px; float: right">
            </a>
        </dd>
    </dl>
</div>
<div class="product-function-point">
    <div class="clearfix">
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>功能点</span>
        </h1>
        <div class="product-point-con clearfix">
            <ul class="product-point-left1">
                <?php foreach ($feature as $i => $item): ?>
                    <?php if ($i % 2 == 0): ?>
                        <li><?= $item ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <ul class="product-point-left1">
                <?php foreach ($feature as $i => $item): ?>
                    <?php if ($i % 2 == 1): ?>
                        <li><?= $item ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<div class="product-describe">
    <div>
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>产品描述</span>
        </h1>
        <p><?= $data->info ?></p>
    </div>
</div>