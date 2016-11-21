<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/28
 * Time: 下午11:53
 *
 * @var \app\models\Orders $item
 */
?>

<div class="order-status-con">
    <div>
        <dl>
            <dt <?= "style=\"background: url('{$item->doctor->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
            <dd>
                <h1><?= $item->doctor->user->name ?></h1>
                <h2>
                    <span><?= $item->doctor->title ?></span>
                </h2>
            </dd>
        </dl>
        <div class="order-list-con-bot clearfix">
            <ul>
                <li><span>服务内容：</span><span><?= $item->serviceName ?></span></li>
                <li><span>创建时间：</span><span><?= $item->ctime ?></span></li>
                <li><span>购买设备：</span></li>
                <?php foreach ($item->products as $prod): ?>
                    <li>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span><?= $prod->product->name ?></span>
                    </li>
                <?php endforeach; ?>
                <li>
                    <span>预约时间：</span>
                    <span>
                        <?= $item->appoint_date ?>
                        <?= isset(\app\models\Office::$time_section[$item->time_section]) ? \app\models\Office::$time_section[$item->time_section] : '' ?>
                    </span>
                </li>
                <li>
                    <span>预约房间：</span>
                    <span>
                        <?php
                        $one = \app\models\Office::findOne($item->office_id);
                        echo !empty($one) ? \app\models\Office::findOne($item->office_id)->name : '';
                        ?>
                    </span>
                </li>
            </ul>
            <ul>
                <li><span>订单状态：</span><span class="blue-color"><?= $item->statusName ?></span></li>
                <li><span>服务地点：</span><span><?= $item->hospital->name ?></span></li>
                <li><span>价格：</span><span><?= $item->price ?></span></li>
            </ul>
        </div>
    </div>
</div>

<?php if ($item->status == \app\models\Orders::STATUS_NEW): ?>
    <?php if ($item->uid == Yii::$app->user->id): ?>
        <div class="order-status-btn">
            <a href="/m/orders/accept/<?= $item->order_id ?>">接受订单</a>
        </div>
    <?php else: ?>
        <div class="order-status-btn">
            <a href="/m/orders/change/<?= $item->order_id ?>?new=1">修改订单</a>
        </div>
        <?php ;endif; ?>
<?php endif; ?>

<?php if ($item->status == \app\models\Orders::STATUS_USER_CONFIRM): ?>
    <?php if ($item->uid == Yii::$app->user->id): ?>
        <div class="order-status-btn">
            <a href="/m/orders/cancel/<?= $item->order_id ?>">取消订单</a>
        </div>
    <?php else: ?>
        <div class="order-status-btn">
            <a href="/m/orders/pay/<?= $item->order_id ?>">订单已支付</a>
        </div>
        <?php ;endif; ?>
<?php endif; ?>

<?php if ($item->status == \app\models\Orders::STATUS_USER_PAY): ?>
    <?php if ($item->uid == Yii::$app->user->id): ?>
        <div class="order-status-btn">
            <a href="/m/orders/done/<?= $item->order_id ?>">完成订单</a>
        </div>
    <?php endif; ?>
<?php endif; ?>
