<div class="wrapper">
    <div class="H-main">
        <?php foreach ($data as $item): ?>
            <a href="/doctor/info/<?=$item->uid?>">
            <div class="H-main-con clearfix">
                <dl class="clearfix">
                    <dt <?= "style=\"background: url('{$item->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                    <dd>
                        <h1 class="clearfix">
                            <span class="H-name"><?= $item->name ?></span>
                            <span class="H-occupation"><?= $item->title ?></span>
                        </h1>
                        <ul class="clearfix">
                            <?php if (!empty($item->service)): ?>
                                <?php foreach ($item->service as $s): ?>
                                    <li><?= \app\models\Service::findOne($s->service_id)->name ?></li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ul>
                        <div class="H-mian-con-bot clearfix">
                            <a href="/doctor/info/<?=$item->uid?>" class="H-mian-state clearfix">
                                <span
                                    class="H-mian-state-collection"><b><?= \app\models\Fav::getCount($item->uid); ?></b>人收藏</span>
                                <span
                                    class="H-mian-order-number">已接订单数 <b><?= \app\models\Orders::getCount($item->uid); ?></b></span>
                            </a>
                            <a href="/doctor/info/<?=$item->uid?>" class="H-appointment-btn">立即预约</a>
                        </div>
                    </dd>
                </dl>
            </div>
            </a>
        <?php endforeach; ?>
    </div>
    <!--分页-->
    <!--
    <div class="paging-con clearfix">
        <div class="paging-left-arrow"><a href="#n">&lt;</a></div>
        <div class="paging-center-con">
            <ul class="clearfix">
                <li><a href="#n" class="active">1</a></li>
                <li><a href="#n">2</a></li>
                <li><a href="#n">3</a></li>
                <li><a href="#n">4</a></li>
                <li><a href="#n">5</a></li>
                <li><a href="#n" class="paging-no-background">....</a></li>
                <li><a href="#n">15</a></li>
                <li><a href="#n">30</a></li>
                <li><a href="#n">45</a></li>
            </ul>
        </div>
        <div class="paging-right-arrow"><a href="#n">&gt;</a></div>
    </div>
    -->
</div>
