<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 下午9:26
 */
?>
<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>产品详情</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <a href="/product/list"><li>产品展示 &gt; </li></a>
                <li>产品详情 &gt; </li>
            </ul>
        </div>
    </div>
    <div class="product-details-main">
        <div class="product-details-top">
            <dl class="clearfix">
                <dt <?= "style=\"background: url('{$data->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                <dd>
                    <h1><?= $data->name ?></h1>
                    <h2>
                        <span class="product-price">价格：</span>
                        <span class="product-number">￥<?= $data->price ?></span>
                    </h2>
                    <p>
                        <span class="product-fitting-range"><b>验配范围：</b>
                            <?php foreach ($scope as $item): ?>
                                <b><?= $item ?></b>
                            <?php endforeach; ?>
                        </span>
                        <span class="product-battery"><b>电池：</b><b><?= $data->battery ?></b></span>
                    </p>
                </dd>
            </dl>
        </div>
        <div class="product-details-center">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>功能点</h1>
            <ul class="clearfix">
                <?php foreach ($feature as $item): ?>
                    <li><?= $item ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="product-details-bottom">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>产品描述</h1>
            <p><?= $data->info ?></p>
        </div>
    </div>
</div>
