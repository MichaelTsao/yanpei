<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/29
 * Time: 上午10:44
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>我的订单</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>我的订单</li>
            </ul>
        </div>
    </div>
    <div class="my-order-main clearfix">
        <?php if (count($data)): ?>
            <?php foreach ($data as $item): ?>
                <?php
                if (!isset($item->doctor) || !isset($item->doctor->user)) {
                    continue;
                }
                ?>
                <a href="/orders/info/<?= $item->order_id ?>">
                    <div class="my-order-con clearfix">
                        <dl class="clearfix">
                            <dt <?= "style=\"background: url('{$item->doctor->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                            <dd>
                                <h1>
                                    <span class="my-order-name"><?= $item->doctor->user->name ?></span>
                                    <span class="my-order-Occupation"><?= $item->doctor->title ?></span>
                                </h1>
                                <ul class="my-order-list1">
                                    <li><span>设备：</span><span><?= count($item->products) ? $item->products[0]->product->name : '' ?></span></li>
                                    <li><span>服务地点：</span><span><?= $item->hospital->name ?></span></li>
                                    <li><span>订单状态：</span><span class="my-order-state"><?= $item->statusName ?></span></li>
                                </ul>
                                <ul class="my-order-list2">
                                    <li><span>服务内容：</span><span><?= $item->service->name ?></span></li>
                                    <li><span>创建时间：</span><span><?= $item->ctime ?></span></li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </a>
            <?php endforeach ?>
        <?php else: ?>
            <div class="NoData">
                <div>
                    <dl>
                        <dt><img src="/res/img/icon-no-data.png" alt=""/></dt>
                        <dd>没有订单,先去和验配师聊聊吧。</dd>
                    </dl>
                </div>
            </div>
            <!--没有进行中内容时显示的内容end-->
        <?php endif ?>
    </div>
    <!--分页-->
<!--    <div class="paging-con clearfix">-->
<!--        <div class="paging-left-arrow"><a href="#n">&lt;</a></div>-->
<!--        <div class="paging-center-con">-->
<!--            <ul class="clearfix">-->
<!--                <li><a href="#n">1</a></li>-->
<!--                <li><a href="#n" class="active">2</a></li>-->
<!--                <li><a href="#n">3</a></li>-->
<!--                <li><a href="#n">4</a></li>-->
<!--                <li><a href="#n">5</a></li>-->
<!--                <li><a href="#n" class="paging-no-background">....</a></li>-->
<!--                <li><a href="#n">15</a></li>-->
<!--                <li><a href="#n">30</a></li>-->
<!--                <li><a href="#n">45</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="paging-right-arrow"><a href="#n">&gt;</a></div>-->
<!--    </div>-->
</div>