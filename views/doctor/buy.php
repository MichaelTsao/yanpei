<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午3:35
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>下单</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>专家团队 &gt; </li>
                <li>联系专家 &gt; </li>
                <li>下单 </li>
            </ul>
        </div>
    </div>
    <div class="place-order-main">
        <div class="place-order-main-top">
            <ul>
                <li onclick="window.location.href='/doctor/choose-service/<?= $uid; ?>'">
                    <span <?= $service ? 'class="active"' : ''; ?>><?= $service ? $service : '请选择服务项目'; ?></span>
                </li>

                <?php foreach ($product as $id => $name): ?>
                    <li onclick="deleteProduct(<?= $id ?>);" class="product">
                        <span onclick="window.location.href='/product/info/<?= $id ?>';event.stopPropagation();" class="active"><?= $name ?></span>
                    </li>
                <?php endforeach; ?>
                <li onclick="window.location.href='/doctor/choose-product/<?= $uid; ?>'">
                    <span>选择产品</span>
                </li>

                <li onclick="window.location.href='/doctor/choose-center/<?= $uid; ?>'">
                    <span <?= $hospital ? 'class="active"' : ''; ?>><?= $hospital ? $hospital : '请选择服务中心'; ?></span>
                </li>
            </ul>
        </div>
        <div class="place-order-main-bottom">
            <h1><span>价格：</span><span><?= $price ?></span></h1>
<!--            <h2>2016-05-18</h2>-->
            <p><a href="/orders/new/<?= $uid ?>">立即下单</a></p>
        </div>
    </div>
</div>

<script>
    function deleteProduct(id) {
        $.get('/m/orders/delete-product?user_id=<?= $uid; ?>&product_id=' + id, function (data) {
            window.location.href = "/doctor/buy/<?= $uid; ?>";
        });

    }
</script>