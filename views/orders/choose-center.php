<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午4:54
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>选择中心</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>订单 &gt; </li>
                <li>选择中心 &gt;</li>
            </ul>
        </div>
        <div class="clearfix big-search-box">
            <p class="big-search-box-con clearfix">
                <span class="H-search-icon search-box-icon"><img src="/res/img/search-icon.png" alt=""/></span>
                <span class="H-search-box"><input type="text" placeholder="搜索"/></span>
            </p>
        </div>
    </div>
    <div class="selection-center-main clearfix">
        <?php foreach ($center as $item): ?>
        <div class="selection-center-con clearfix" onclick="select(this.id)" id="<?= $item->hospital_id; ?>">
            <dl class="clearfix">
                <dt <?= "style=\"background: url('{$item->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                <dd>
                    <h1><?= $item->name ?></h1>
                    <p><?= $item->location ?></p>
                </dd>
            </dl>
        </div>
        <?php endforeach;?>
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

<script>
    function select(id) {
        $.get('/m/orders/set-order-hospital?order_id=<?= $order_id; ?>&hospital_id='+id, function (data) {
            window.location.href = "/orders/choose-office/<?= $order_id; ?>";
        });
    }
</script>