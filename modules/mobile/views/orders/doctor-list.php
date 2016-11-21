<div class="B-main-big-box">
    <div class="B-main">
        <?php if (count($data)): ?>
            <?php foreach ($data as $item): ?>
                <a href="/m/orders/info/<?= $item->order_id ?>">
                    <div class="order-list-con">
                        <div>
                            <dl>
                                <dt <?= "style=\"background: url('{$item->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                                <dd>
                                    <h1><?= $item->user->name ?></h1>
                                    <h2>
                                        <span></span>
                                    </h2>
                                </dd>
                            </dl>
                            <div class="order-list-con-bot clearfix">
                                <ul>
                                    <li><span>服务内容：</span><span><?= $item->serviceName ?></span></li>
                                    <li><span>创建时间：</span><span><?= $item->ctime ?></span></li>
                                    <li><span>订单状态：</span><span class="blue-color"><?= $item->statusName ?></span></li>
                                </ul>
                                <ul>
                                    <li>
                                        <span>设备：</span><span><?= count($item->products) ? $item->products[0]->product->name : '' ?></span>
                                    </li>
                                    <li><span>服务地点：</span><span><?= $item->hospital->name ?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        <?php else: ?>
            <!--没有进行中内容时显示的内容start-->
            <div class="NoData">
                <div>
                    <dl>
                        <dt><img src="/res/img/icon-no-data.png" alt=""/></dt>
                        <dd>没有订单</dd>
                    </dl>
                </div>
            </div>
            <!--没有进行中内容时显示的内容end-->
        <?php endif ?>
    </div>
</div>