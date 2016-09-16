<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午4:44
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>选择设备</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>专家团队 &gt; </li>
                <li>联系专家 &gt; </li>
                <li>查看病历 &gt;</li>
            </ul>
        </div>
        <div class="clearfix big-search-box">
            <p class="big-search-box-con clearfix">
                <span class="H-search-icon search-box-icon"><img src="/res/img/search-icon.png" alt=""/></span>
                <span class="H-search-box"><input type="text" placeholder="搜索"/></span>
            </p>
        </div>
    </div>
    <div class="product-display-main selection-device-main clearfix">
        <div class="clearfix">
            <?php foreach ($product as $i => $item): ?>
                <div class="product-display-box<?php if ($i % 3 == 1) echo ' clearance' ?>" onclick="select(this.id)" id="<?= $item->product_id; ?>">
                    <dl>
                        <dt <?= "style=\"background: url('{$item->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                        <dd>
                            <a onclick="window.location.href='/product/info/<?=$item->product_id?>';event.stopPropagation();">
                                <p class="product-display-text"><?= $item->name ?></p>
                            </a>
                            <p>
                                <span class="product-display-price">价格：</span>
                                <span class="product-display-number">￥<?= $item->price ?></span>
                            </p>
                        </dd>
                    </dl>
                </div>
            <?php endforeach; ?>
        </div>
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
        $.get('/m/orders/add-order-product?order_id=<?= $order_id; ?>&product_id='+id, function (data) {
            window.location.href = "/orders/change/<?= $order_id; ?>";
        });
    }
</script>