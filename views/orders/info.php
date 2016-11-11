<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午3:13
 */

use app\models\base\Common;

?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>我的订单</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>我的订单 &gt; </li>
            </ul>
        </div>
    </div>
    <div class="my-order-main order-details-main clearfix">
        <div class="my-order-con clearfix">
            <dl class="clearfix">
                <dt class="order-details-img" <?= "style=\"background: url('{$item->doctor->user->icon}')no-repeat center center; background-size: cover\"" ?>>
                </dt>
                <dd class="order-details-con1 clearfix">
                    <h1>
                        <span class="my-order-name"><?= $item->doctor->user->name ?></span>
                        <span class="my-order-Occupation"><?= $item->doctor->title ?></span>
                    </h1>
                    <div class="clearfix">
                        <ul class="my-order-list1 ">
                            <li><span>设备：</span><span>
                                    <?php foreach ($item->products as $prod): ?>
                            <li>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <span><?= $prod->product->name ?></span>
                            </li>
                            <?php endforeach; ?>

                            </span></li>
                            <li><span>服务地点：</span><span><?= $item->hospital->name ?></span></li>
                            <li>
                                <span>服务房间：</span>
                                <span>
                                    <?= !empty(\app\models\Office::findOne($item->office_id)) ? Common::setObjEcho(\app\models\Office::findOne($item->office_id)->name) : ''?>
                                </span>
                            </li>
                            <li><span>订单ID：</span><span><?= $item->order_id ?></span></li>
                        </ul>
                        <ul class="my-order-list2">
                            <li><span>服务内容：</span><span><?= $item->service->name ?></span></li>
                            <li><span>订单状态：</span><span class="my-order-state"><?= $item->statusName ?></span></li>
                            <li><span>预约时间：</span><span><?= $item->appoint_date ?></span></li>
                            <li><span>创建时间：</span><span><?= $item->ctime ?></span></li>
                            <li><span>价格：</span><span style="color: #e51717"><?= $price ?></span></li>
                        </ul>
                    </div>
                    <div class="order-details-btn">
                        <?php if ($item->status == \app\models\Orders::STATUS_NEW): ?>
                            <?php if ($item->uid == Yii::$app->user->id): ?>
                                <a href="/orders/accept/<?= $item->order_id ?>">接受订单</a>
                            <?php else: ?>
                                <a href="/orders/change/<?= $item->order_id ?>?new=1">修改订单</a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($item->status == \app\models\Orders::STATUS_USER_CONFIRM): ?>
                            <?php if ($item->uid == Yii::$app->user->id): ?>
                                <a href="/orders/cancel/<?= $item->order_id ?>">取消订单</a>
                            <?php else: ?>
                                <a href="/orders/pay/<?= $item->order_id ?>">订单已支付</a>
                                <?php ;endif; ?>
                        <?php endif; ?>

                        <?php if ($item->status == \app\models\Orders::STATUS_USER_PAY): ?>
                            <?php if ($item->uid == Yii::$app->user->id): ?>
                                <a href="/orders/done/<?= $item->order_id ?>">完成订单</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </dd>
            </dl>
        </div>
    </div>
</div>